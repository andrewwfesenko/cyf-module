document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelector('.steps');
    const inputs = steps.querySelectorAll('input:not([type="radio"]):not([type="checkbox"])');

    inputs.forEach(input => {
        toggleInputFilledState(input);
        input.addEventListener('input', () => {
            toggleInputFilledState(input);
        });
    });

    function toggleInputFilledState(input) {
        if (input.value.trim() === '') {
            input.classList.remove('filled');
            input.closest('.step').querySelector('button').classList.remove('filled');
        } else {
            input.classList.add('filled');
            input.closest('.step').querySelector('button').classList.add('filled');
        }
    }

    const nextButtons = document.querySelectorAll('.next-button');
    const editButtons = document.querySelectorAll('.edit-button');

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            const step = button.closest('.step');
            if (!step) return;

            const selectedInput = step.querySelector(
                'input[type="radio"]:checked, input[type="checkbox"]:checked'
            );
            if (!selectedInput) return;

            const selectedLabel = selectedInput.labels[0];
            const selectedStepOption = selectedLabel?.closest('.step-option');

            step.classList.add('closed');

            console.log(step.nextSibling);
            step.nextElementSibling.classList.remove('closed');

            selectedStepOption?.classList.add('selected-option');
        });
    });

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const step = button.closest('.step');
            if (!step) return;

            step.classList.remove('closed');

            const selectedInput = step.querySelector(
                'input[type="radio"]:checked, input[type="checkbox"]:checked'
            );
            if (selectedInput) {
                const selectedLabel = selectedInput.labels[0];
                const selectedStepOption = selectedLabel?.closest('.step-option');
                selectedStepOption?.classList.remove('selected-option');
            }

            const allSteps = document.querySelectorAll('.step');
            allSteps.forEach(s => {
                if (s !== step) {
                    s.classList.add('closed');
                }
            });
        });
    });
});
