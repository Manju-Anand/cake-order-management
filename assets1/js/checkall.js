document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Check All Function
    document.getElementById('checkAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.main-mail-list .form-check-input');

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = this.checked;

            // You can add additional logic here based on the checkbox state
            if (this.checked) {
                checkbox.closest('.main-mail-item').classList.add('selected');
            } else {
                checkbox.closest('.main-mail-item').classList.remove('selected');
            }
        }, this);
    });
});