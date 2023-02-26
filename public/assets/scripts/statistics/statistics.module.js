
import {addDateSelectorListeners, getSelectedDateRange} from '../date-range-selector.js';
import {formatDateDot} from '../util/format-date.js';

getSelectedDateRange();

const chart = new Chart('weightRecordings', {
    type: "line",
    data: {
        labels: weightRecordingsData.map(row => formatDateDot(new Date(row.dateOfRecording))),
        datasets: [
            {
                fill: false,
                lineTension: 0,
                backgroundColor: "#1E9C61",
                borderColor: "#43E89B",
                data: weightRecordingsData.map(row => row.weight)
            }
        ]
    },
    options: {
        legend: {display: false},
        scales: {
            yAxes: [
                {
                    ticks: {
                        min: 0,
                        max: Math.max(...weightRecordingsData.map(row => row.weight)) + 15
                    }
                }
            ],
        }
    }
});


addDateSelectorListeners(filterValues)

function filterValues(fromDate, toDate) {
    if (fromDate != null && toDate != null) {
        const filtered = weightRecordingsData.filter(recording => {
            const dateValue = new Date(recording.dateOfRecording)
            return dateValue.valueOf() >= fromDate.valueOf() && dateValue.valueOf() <= toDate.valueOf()
        });

        chart.data.labels = filtered.map(row => formatDateDot(new Date(row.dateOfRecording)))
        chart.data.datasets[0].data = filtered.map(row => row.weight)
        chart.update();
    }
}