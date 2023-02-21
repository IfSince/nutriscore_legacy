const values = weightRecordingsData.map(row => row.weight)
const labels = weightRecordingsData.map(row => row.dateOfRecording)

new Chart('weightRecordings', {
    type: "line",
    data: {
        labels: labels,
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
                        max: Math.max(...values) + 15
                    }
                }
            ],
        }
    }
});