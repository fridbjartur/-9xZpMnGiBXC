let questionForm = document.getElementById('js_create_question');
let questionFormType = document.getElementById('js_question_type');
let questionFormAnswers = document.querySelectorAll('.js_incorrect_answers');
let questionFormHidden = 'form_hidden';

const removeHidden = (elem) => {
    elem.classList.remove(questionFormHidden);
};
const addHidden = (elem) => {
    elem.classList.add(questionFormHidden);
};

if (questionFormAnswers.length > 0) {
    let i;
    questionFormType.addEventListener('change', () => {
        switch(questionFormType.value) {
            case "1":
                for (i = 0; i < questionFormAnswers.length; i++) {
                    removeHidden(questionFormAnswers[i]);
                }
                break;
            case "2":
                removeHidden(questionFormAnswers[0]);
                for (i = 1; i < questionFormAnswers.length; i++) {
                    addHidden(questionFormAnswers[i]);
                }
                break;
            case "3":
                for (i = 0; i < questionFormAnswers.length; i++) {
                    addHidden(questionFormAnswers[i]);
                }
          }
	});
  }