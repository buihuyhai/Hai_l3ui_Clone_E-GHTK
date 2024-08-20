//nhuandt3
(function() {
    'use strict';

    //Select All
    const btnSelectAll = document.querySelector('.select-all');
    const selectItems = document.querySelectorAll('.select-item');
    const selectBulkAction = document.querySelector('.select-bulk-action');

    if (btnSelectAll)
        btnSelectAll.addEventListener('change', function() {
            if (this.checked === true) {
                changeSelectItems(selectItems, true);
            } else {
                changeSelectItems(selectItems, false);
            }
        });

    const changeSelectItems = function(selectItems, checked) {
        selectItems.forEach(function(item, index) {
            item.checked = checked;
        });
    };

    //Form Bulk Action
    const bulkActionForm = document.getElementById('bulk-action-form');
    const btnBulkAction = document.querySelector('.btn-bulk-action');

    if (btnBulkAction)
        btnBulkAction.addEventListener('click', function() {

            const wrapper = document.createElement('div');
            wrapper.hidden = 'hidden';
            selectItems.forEach(function(item, index) {
                wrapper.appendChild(item);
            });

            bulkActionForm.appendChild(wrapper);

            bulkActionForm.submit();
        });

})();
