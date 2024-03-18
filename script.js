/* fonction qui s'assure que la captcha a été remplie */

function validateForm() {
    var response = grecaptcha.getResponse();
    if (response.length == 0) {
        alert("Veuillez remplir le captcha.");
        return false;
    }
    return true;
}



let questionCount = 0;

function ajouterReponse(questionIndex) {
    let questionContainer = document.getElementById(`question-${questionIndex}`);
    if (questionContainer) {
        let reponsesContainer = questionContainer.querySelector('.reponses-container');
        if (reponsesContainer) {
            let reponseDiv = document.createElement('div');
            reponseDiv.classList.add('reponse');
            reponseDiv.innerHTML = `
                <input type="text" name="reponses[${questionIndex}][]" placeholder="Réponse">
                <select name="valeur_reponse_${questionIndex}[]">
                    <option value="Bonne réponse">Bonne réponse</option>
                    <option value="Mauvaise réponse">Mauvaise réponse</option>
                </select>
                <button type="button" onclick="supprimerReponse(${questionIndex})">Supprimer la réponse</button>
            `;
            reponsesContainer.appendChild(reponseDiv);
        }
    }
}


function ajouterQuestion() {
    questionCount++;
    let questionContainer = document.getElementById('questionsContainer');
    let questionDiv = document.createElement('div');
    questionDiv.classList.add('question');
    questionDiv.id = `question-${questionCount}`;
    questionDiv.innerHTML = `
        <h2>Question ${questionCount}</h2>
        <input type="text" name="question[]" placeholder="Question">
        <div class="reponses-container"></div>
        <button type="button" onclick="ajouterReponse(${questionCount})">Ajouter une réponse</button>
        <input type="number" name="points[]" placeholder="Points">
    `;
    questionContainer.appendChild(questionDiv);
}

function supprimerReponse(questionIndex) {
    let questionContainer = document.getElementById(`question-${questionIndex}`);
    if (questionContainer) {
        let reponsesContainer = questionContainer.querySelector('.reponses-container');
        if (reponsesContainer && reponsesContainer.children.length > 1) {
            reponsesContainer.removeChild(reponsesContainer.lastChild);
        }
    }
}

function supprimerQuestion() {
    let questionContainer = document.getElementById('questionsContainer');
    if (questionCount > 0) {
        questionContainer.removeChild(questionContainer.lastChild);
        questionCount--;
    }
}
