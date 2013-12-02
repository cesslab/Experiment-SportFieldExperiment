$(function() {
    var treatmentSelections = [
        { checkboxId: "#riskAversionCheckbox", itemGroup: "#riskAversionGroup"},
        { checkboxId: "#willingnessPayCheckbox", itemGroup: "#willingnessPayGroup"},
        { checkboxId: "#ultimatumCheckbox", itemGroup: "#ultimatumGroup"},
        { checkboxId: "#trustCheckbox", itemGroup: "#trustGroup"},
        { checkboxId: "#dictatorCheckbox", itemGroup: "#dictatorGroup"}
    ];

    var clickToggleListener = function(checkbox, itemGroup) {
        return function() {
            console.log("item clicked");
            if (this.checked) {
                $(itemGroup).fadeIn();
            }
            else {
                $(itemGroup).fadeOut();
            }
        }
    }

    for (var i = 0; i < treatmentSelections.length; ++i) {
        if ( ! $(treatmentSelections[i].checkboxId).is(":checked")) {
            $(treatmentSelections[i].itemGroup).hide();
        }
        $(treatmentSelections[i].checkboxId).click(clickToggleListener(treatmentSelections[i].checkboxId,  treatmentSelections[i].itemGroup));
    }
});