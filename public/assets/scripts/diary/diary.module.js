import {setCircleFillPercentage} from '../util/set-circle-fill-percentage.js';
import {TIME_OF_DAY} from './time-of-day.enum.js';
import {updateRowData} from './update-row-data.js';
import {addDateSelectorListeners, getSelectedDate} from '../date-selector.js';

setCircleFillPercentage()
addDateSelectorListeners(updateValuesByDate)

const breakfastContainer = document.querySelector('#breakfastContainer');
const lunchContainer = document.querySelector('#lunchContainer');
const dinnerContainer = document.querySelector('#dinnerContainer');
const snacksContainer = document.querySelector('#snacksContainer');

function updateValuesByDate(selectedDate) {
    const filteredByDate = recordingData.filter(recording => recording.dateOfRecording === selectedDate)

    const breakfastRecordings = filteredByDate.filter(recording => recording.timeOfDay === TIME_OF_DAY.BREAKFAST)
    const lunchRecordings = filteredByDate.filter(recording => recording.timeOfDay === TIME_OF_DAY.LUNCH)
    const dinnerRecordings = filteredByDate.filter(recording => recording.timeOfDay === TIME_OF_DAY.DINNER)
    const snacksRecordings = filteredByDate.filter(recording => recording.timeOfDay === TIME_OF_DAY.SNACKS)

    updateRowData(breakfastContainer, breakfastRecordings)
    updateRowData(lunchContainer, lunchRecordings)
    updateRowData(dinnerContainer, dinnerRecordings)
    updateRowData(snacksContainer, snacksRecordings)
}

// initial loading
const today = new Date()
updateValuesByDate(getSelectedDate())


const currentDate = new Date();
const startDate = new Date(currentDate.getFullYear(), 0, 1);
var days = Math.floor((currentDate - startDate) /
    (24 * 60 * 60 * 1000));

var weekNumber = Math.ceil(days / 7);