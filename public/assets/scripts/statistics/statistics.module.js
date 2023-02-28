import {addDateSelectorListeners, getSelectedDateRange} from '../date-range-selector.js';
import {formatDateDot} from '../util/format-date.js';

getSelectedDateRange();

const chart = new Chart('weightRecordings', {
    type: 'line',
    data: {
        labels: weightRecordingsData.map(row => formatDateDot(new Date(row.dateOfRecording))),
        datasets: [
            {
                fill: false,
                lineTension: 0,
                backgroundColor: '#1E9C61',
                borderColor: '#43E89B',
                data: weightRecordingsData.map(row => row.weight),
            },
        ],
    },
    options: {
        legend: { display: false },
    },
});

function filterValues(fromDate, toDate) {
    const newChartData = (
        fromDate != null && toDate != null
    ) ?
        weightRecordingsData.filter(recording => {
            const dateValue = new Date(recording.dateOfRecording)
            return dateValue.valueOf() >= fromDate.valueOf() && dateValue.valueOf() <= toDate.valueOf()
        }) : weightRecordingsData

    chart.data.labels = newChartData.map(row => formatDateDot(new Date(row.dateOfRecording)))
    chart.data.datasets[0].data = newChartData.map(row => row.weight)
    chart.update();
}

addDateSelectorListeners(filterValues)

//initial loading
const { from, to } = getSelectedDateRange()
filterValues(from, to)