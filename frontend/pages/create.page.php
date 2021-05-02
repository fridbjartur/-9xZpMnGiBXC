<?php
$aCategories =  $items->getFilters('categories');
$aDifficulties =  $items->getFilters('difficulties');
$aTypes =  $items->getFilters('types');
// print_r($_POST);
// if (!empty($_POST['incorrect_answer'])) {
//     print_r(array_filter($_POST['incorrect_answer']));
// }
?>

<div class="row justify-content-md-center">
    <div class="col col-lg-6">
        <h2 class="">Create question</h2>

        <form id="js_create_question" action="/create-api" method="post">
            <div class="mb-3">
                <label for="question" class="form-label">Question:</label>
                <input type="text" name="question" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category">Select Category: </label>
                <select name="category" class="form-control" required>
                    <option disabled selected value> -- select an option -- </option>
                    <?php
                    foreach ($aCategories as $category) {
                        echo '<option value="' . $category['category_id'] . '">' . $category['category_title'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="difficulty">Select Difficulty: </label>
                <select name="difficulty" class="form-control" required>
                    <option disabled selected value> -- select an option -- </option>
                    <?php
                    foreach ($aDifficulties as $difficulty) {
                        echo '<option value="' . $difficulty['difficulty_id'] . '">' . $difficulty['difficulty_title'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="type">Select Type:</label>
                <select name="type" class="form-control" id="js_question_type" required>
                    <option disabled selected value> -- select an option -- </option>
                    <?php
                    foreach ($aTypes as $type) {
                        echo '<option value="' . $type['type_id'] . '">' . $type['type_title'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="correct_answer" class="form-label">Correct answer:</label>
                <input type="text" name="correct_answer" class="form-control" required>
            </div>
            <div class="mb-3 js_incorrect_answers form_hidden">
                <label for="correct_answer_01" class="form-label">Answer possibility 1:</label>
                <input type="text" name="incorrect_answer[]" class="form-control">
            </div>
            <div class="mb-3 js_incorrect_answers form_hidden">
                <label for="correct_answer_02" class="form-label">Answer possibility 2:</label>
                <input type="text" name="incorrect_answer[]" class="form-control">
            </div>
            <div class="mb-3 js_incorrect_answers form_hidden">
                <label for="correct_answer_03" class="form-label">Answer possibility 3:</label>
                <input type="text" name="incorrect_answer[]" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Create question</button>
            </div>
        </form>
    </div>
</div>