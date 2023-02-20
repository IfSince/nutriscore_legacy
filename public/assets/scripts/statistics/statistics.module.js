// (async function() {
//     const data = [
//         { day: 2010, count: 10 },
//         { day: 2011, count: 20 },
//         { day: 2012, count: 15 },
//         { day: 2013, count: 25 },
//         { day: 2014, count: 22 },
//         { day: 2015, count: 30 },
//         { day: 2016, count: 28 },
//     ];
//
//     new Chart(
//         document.getElementById('weightRecordings'),
//         {
//             type: 'line',
//             data: {
//                 labels: data.map(row => row.day),
//                 datasets: [
//                     {
//                         label: 'Weight',
//                         data: data.map(row => row.count)
//                     }
//                 ]
//             }
//         }
//     );
// })();

let xValues = [50,60,70,80,90,100,110,120,130,140,150];
let yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart('weightRecordings', {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
        }]
    },
    options: {
        legend: {display: false},
        scales: {
            yAxes: [{ticks: {min: 6, max:16}}],
        }
    }
});