(function () {
    "use strict";
    function replay() {
        let replayButtons = document.querySelectorAll('.reply a');
    
        replayButtons.forEach((button) => {
            button.addEventListener('click', () => {
                let replay = button.parentElement;
    
                // Creating Div
                let div = document.createElement('div');
                div.setAttribute('class', 'comment mt-4 d-grid');
    
                // Creating textarea
                let textArea = document.createElement('textarea');
                textArea.setAttribute('class', 'form-control');
                textArea.setAttribute('rows', '5');
                textArea.innerText = 'Your Comment';
    
                // Creating Cancel button
                let cancelButton = document.createElement('button');
                cancelButton.setAttribute('class', 'btn me-2 btn-danger');
                cancelButton.innerText = 'Cancel';
    
                // Creating submit button
                let submitButton = document.createElement('button');
                submitButton.setAttribute('class', 'btn btn-success');
                submitButton.innerText = 'Submit';
    
                // Creating button div
                let buttonDiv = document.createElement('div');
                buttonDiv.setAttribute('class', 'btn-list ms-auto mt-2');
    
                // Appending elements to div
                div.appendChild(textArea);
                div.appendChild(buttonDiv);
                buttonDiv.appendChild(cancelButton);
                buttonDiv.appendChild(submitButton);
    
                // Appending div to the parent element
                replay.appendChild(div);
    
                // Event listener for cancel button
                cancelButton.addEventListener('click', () => {
                    div.remove();
                });
            });
        });
    }
    
    // Call the function when the document is ready
    document.addEventListener('DOMContentLoaded', replay);
})();