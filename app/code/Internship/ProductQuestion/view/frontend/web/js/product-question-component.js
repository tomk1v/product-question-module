<!--
/**
 * Product Question
 * Validation & sending data
 *
 * @category Internship
 * @package Internship\ProductQuestion
 * @author Andrii Tomkiv <tomkivandrii18@gmail.com>
 * @copyright 2024 Tomkiv
 */
-->
require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        let options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            buttons: [{
                text: $.mage.__('Close'),
                class: 'product-question-modal',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        modal(options, $('#product-question-modal'));

        $("#question-button").on('click', function () {
            $("#product-question-modal").modal("openModal");
        });

        $("#submit-question").on('click', function () {
            if (validateFormQuestion()) {
                sendQuestion();
            }
        });

        function sendQuestion() {
            $.ajax({
                url: '/product/email/question',
                showLoader: true,
                data: {
                    name: $('#name').val().trim(),
                    email: $('#email').val().trim(),
                    question: $('#question').val().trim(),
                    product_sku: $('.product.attribute.sku .value').text()
                },
                dataType: 'json',
                type: 'POST',
                success: function () {
                    $("#product-question-modal").modal("closeModal");
                }
            });
        }

        function validateFormQuestion() {
            const fields = ['#name', '#email', '#question'];
            for (let field of fields) {
                const value = $(field).val().trim();
                const hintClass = `${field}-hint`;

                if (value == null || value === "") {
                    $(`.${hintClass}`).show();
                    return false;
                }
            }
            return true;
        }
    });
