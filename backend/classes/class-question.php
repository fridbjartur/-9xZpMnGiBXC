<?php
class Question
{

    // Connection
    private $db;

    // Tables
    private $answers_table = "answers";
    private $lookup_table;

    // Db connection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // GET ALL QUESTIONS
    public function getQuestions($aConditions = array())
    {
        $sQuery = "
            SELECT
                questions.question_id AS id,
                group_concat(users.user_first_name,' ',users.user_last_name) AS author,
                categories.category_title AS category,
                types.type_title AS type,
                difficulties.difficulty_title AS difficulty,
                questions.question_text AS question,
                answers.answer_text AS correct_answer,
                questions.question_created AS created
            FROM questions
            INNER JOIN users ON questions.question_user_fk = users.user_id
            INNER JOIN categories ON questions.question_category_fk = categories.category_id
            INNER JOIN types ON questions.question_type_fk = types.type_id
            INNER JOIN difficulties ON questions.question_difficulty_fk = difficulties.difficulty_id
            INNER JOIN answers ON questions.question_id = answers.answer_question_fk AND answers.answer_is_correct = 1
        ";

        $amount = array_key_exists("amount", $aConditions) ? $aConditions['amount'] : 50000;
        if (array_key_exists("category", $aConditions)) {
            $sQuery .= " AND questions.question_category_fk = '$aConditions[category]' ";
        }
        if (array_key_exists("type", $aConditions)) {
            $sQuery .= " AND questions.question_type_fk = '$aConditions[type]' ";
        }
        if (array_key_exists("difficulty", $aConditions)) {
            $sQuery .= " AND questions.question_difficulty_fk = '$aConditions[difficulty]' ";
        }
        $sQuery .= " GROUP BY id ";
        if (array_key_exists("random", $aConditions)) {
            $sQuery .= " ORDER BY RAND() ";
        }
        $sQuery .= " LIMIT :amount ";
        try {
            $q =  $this->db->prepare($sQuery);
            $q->bindValue(':amount', $amount, PDO::PARAM_INT);
            $q->execute();
            return $q;
        } catch (Exception $ex) {
            echo "Database could not be connected: " . $ex->getMessage();
        }
    }

    // GET ANSWERS BY ID
    public function getAnswers($questionId)
    {
        try {
            $q =  $this->db->prepare("SELECT answer_text FROM $this->answers_table WHERE answer_question_fk = :questionId AND answer_is_correct = false");
            $q->bindValue(':questionId', $questionId);
            $q->execute();
            while ($aRow = $q->fetch()) {
                $aAnswers[] = $aRow['answer_text'];
            }
            if (empty($aAnswers)) {
                return (array());
            }
            return ($aAnswers);
        } catch (Exception $ex) {
            echo "Database could not be connected: " . $ex->getMessage();
        }
    }

    // GET FILTERS BY TYPE
    public function getFilters($condition)
    {
        switch ($condition) {
            case "categories":
                $this->lookup_table = "categories";
                break;
            case "types":
                $this->lookup_table = "types";
                break;
            case "difficulties":
                $this->lookup_table = "difficulties";
                break;
            default:
                return (array());
                break;
        }
        try {
            $q =  $this->db->prepare("SELECT * FROM $this->lookup_table");
            $q->execute();
            $aRow = $q->fetchAll();
            return ($aRow);
        } catch (Exception $ex) {
            echo "Database could not be connected: " . $ex->getMessage();
        }
    }

    public function createQuestion($condition)
    {
        try {
            $this->db->beginTransaction();
            $q = $this->db->prepare('
            INSERT INTO questions
            (`question_user_fk`,
            `question_category_fk`,
            `question_type_fk`,
            `question_difficulty_fk`,
            `question_text`)
            VALUES
            (:question_user_fk,
            :question_category_fk,
            :question_type_fk,
            :question_difficulty_fk,
            :question_text)');
            $q->bindValue(':question_user_fk', $_SESSION['user_id']);
            $q->bindValue(':question_category_fk', $condition['category']);
            $q->bindValue(':question_type_fk', $condition['type']);
            $q->bindValue(':question_difficulty_fk', $condition['difficulty']);
            $q->bindValue(':question_text', $condition['question']);
            $q->execute();
            $lastInsertedId = $this->db->lastInsertId();

            $q = $this->db->prepare('
            INSERT INTO `answers` (`answer_question_fk`, `answer_text`, `answer_is_correct`)
            VALUES (:answer_question_fk, :answer_text, :answer_is_correct)
            ');
            $q->bindValue(':answer_question_fk', $lastInsertedId);
            $q->bindValue(':answer_text', $condition['correct_answer']);
            $q->bindValue(':answer_is_correct', 1);
            $q->execute();

            $incorrectAnswers = array_filter($condition['incorrect_answer']);
            if (!empty($incorrectAnswers)) {
                foreach ($incorrectAnswers as $value) {
                    $q = $this->db->prepare('
                INSERT INTO `answers` (`answer_question_fk`, `answer_text`, `answer_is_correct`)
                VALUES (:answer_question_fk, :answer_text, :answer_is_correct)
                ');
                    $q->bindValue(':answer_question_fk', $lastInsertedId);
                    $q->bindValue(':answer_text', $value);
                    $q->bindValue(':answer_is_correct', 0);
                    $q->execute();
                }
            }
            $this->db->commit();
            header('Location: /create');
        } catch (Exception $ex) {
            $this->db->rollback();
            echo "Database could not be connected: " . $ex->getMessage();
        }
    }
}
