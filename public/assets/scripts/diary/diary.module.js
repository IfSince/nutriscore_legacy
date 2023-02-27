import {setCircleFillPercentage} from '../util/set-circle-fill-percentage.js';
import {TIME_OF_DAY} from './time-of-day.enum.js';
import {updateRowData} from './update-row-data.js';
import {addDateSelectorListeners, getSelectedDate} from '../date-selector.js';

setCircleFillPercentage()
addDateSelectorListeners(updateValuesByDate)

// Recordings Container
const breakfastContainer = document.querySelector('#breakfastContainer')
const lunchContainer = document.querySelector('#lunchContainer')
const dinnerContainer = document.querySelector('#dinnerContainer')
const snacksContainer = document.querySelector('#snacksContainer')

// Intake Elements
const calorieIntakeElement = document.querySelector('#calorieIntake')
const calorieIntakeNumberElement = document.querySelector('#calorieIntakeNumber')
const proteinIntakeElement = document.querySelector('#proteinIntake')
const proteinIntakePercentageElement = document.querySelector('#proteinIntakePercentage')
const carbohydratesIntakeElement = document.querySelector('#carbohydratesIntake')
const carbohydratesIntakePercentageElement = document.querySelector('#carbohydratesIntakePercentage')
const fatIntakeElement = document.querySelector('#fatIntake')
const fatIntakePercentageElement = document.querySelector('#fatIntakePercentage')

function updateValuesByDate(selectedDate) {
    const filteredRecordings = recordingData.filter(recording => recording.dateOfRecording === selectedDate)

    const breakfastRecordings = filteredRecordings.filter(recording => recording.timeOfDay === TIME_OF_DAY.BREAKFAST)
    const lunchRecordings = filteredRecordings.filter(recording => recording.timeOfDay === TIME_OF_DAY.LUNCH)
    const dinnerRecordings = filteredRecordings.filter(recording => recording.timeOfDay === TIME_OF_DAY.DINNER)
    const snacksRecordings = filteredRecordings.filter(recording => recording.timeOfDay === TIME_OF_DAY.SNACKS)

    updateRowData(breakfastContainer, breakfastRecordings)
    updateRowData(lunchContainer, lunchRecordings)
    updateRowData(dinnerContainer, dinnerRecordings)
    updateRowData(snacksContainer, snacksRecordings)

    updateIntakeValues(filteredRecordings)
}

function updateIntakeValues(filteredRecordings) {
    let calorieIntake = 0
    let proteinIntake = 0
    let carbohydratesIntake = 0
    let fatIntake = 0
    filteredRecordings.forEach(recording => {
        calorieIntake += recording.calories * recording.amount
        proteinIntake += recording.protein * recording.amount
        carbohydratesIntake += recording.carbohydrates * recording.amount
        fatIntake += recording.fat * recording.amount
    });

    calorieIntakeElement.setAttribute('data-percentage', (calorieIntake / personDTO.calorieIntake) * 100)
    calorieIntakeNumberElement.innerHTML = calorieIntake;

    proteinIntakeElement.innerHTML = proteinIntake.toFixed()
    proteinIntakePercentageElement.style.width = `${ Math.min((proteinIntake / personDTO.proteinIntake) * 100, 100) }%`

    carbohydratesIntakeElement.innerHTML = carbohydratesIntake.toFixed()
    carbohydratesIntakePercentageElement.style.width = `${ Math.min((carbohydratesIntake / personDTO.carbohydratesIntake) * 100, 100) }%`

    fatIntakeElement.innerHTML = fatIntake.toFixed()
    fatIntakePercentageElement.style.width = `${ Math.min((fatIntake / personDTO.fatIntake) * 100, 100) }%`

    setCircleFillPercentage()
}

// initial loading
updateValuesByDate(getSelectedDate())

