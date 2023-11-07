var adultsCount = 1;
var childrenCount = 0;
var guestsInput = document.getElementById('guestsInput');
var adultsCountElement = document.getElementById('adultsCount');
var childrenCountElement = document.getElementById('childrenCount');
var popover = document.querySelector('.p-over');
var popoverContent = document.querySelector('.p-over-content');

function updateGuestsInput() {
    var adultsText = adultsCount === 1 ? 'adult' : 'adults';
    var childrenText = childrenCount === 1 ? 'child' : 'children';
    guestsInput.value = adultsCount + ' ' + adultsText + ' ' + childrenCount + ' ' + childrenText;
}

function updateCounts() {
    adultsCountElement.textContent = adultsCount;
    childrenCountElement.textContent = childrenCount;
    updateGuestsInput();
}

function decrementCount(type) {
    if (type === 'adults') {
        if (adultsCount > 1) {
            adultsCount--;
        }
    } else if (type === 'children') {
        if (childrenCount > 0) {
            childrenCount--;
        }
    }
    updateCounts();
}

function incrementCount(type) {
    if (type === 'adults') {
        adultsCount++;
    } else if (type === 'children') {
        childrenCount++;
    }
    updateCounts();
}

function handleClickOutside(event) {
    if (!popover.contains(event.target)) {
        popover.classList.remove('active');
    }
}

document.getElementById('adultsDecrement').addEventListener('click', function (event) {
    event.preventDefault();
    decrementCount('adults');
});

document.getElementById('adultsIncrement').addEventListener('click', function (event) {
    event.preventDefault();
    incrementCount('adults');
});

document.getElementById('childrenDecrement').addEventListener('click', function (event) {
    event.preventDefault();
    decrementCount('children');
});

document.getElementById('childrenIncrement').addEventListener('click', function (event) {
    event.preventDefault();
    incrementCount('children');
});

guestsInput.addEventListener('click', function (event) {
    event.preventDefault();
    console.log('Guests Input clicked!');
    popover.classList.toggle('active');
});

document.addEventListener('click', handleClickOutside);

updateGuestsInput();