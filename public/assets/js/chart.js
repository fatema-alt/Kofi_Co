document.addEventListener('DOMContentLoaded', function () {
    const dailyCanvas = document.getElementById('dailySalesChart');
    const categoryCanvas = document.getElementById('categorySalesChart');

    setTimeout(function () {

        if (dailyCanvas && typeof dailyLabels !== 'undefined') {
            const dailyCtx = dailyCanvas.getContext('2d');

            if (window.dailySalesChartInstance) {
                window.dailySalesChartInstance.destroy();
            }

            const dailyGradient = dailyCtx.createLinearGradient(0, 0, 0, 300);
            dailyGradient.addColorStop(0, '#C9A66B');
            dailyGradient.addColorStop(1, '#6F4E37');

            window.dailySalesChartInstance = new Chart(dailyCanvas, {
                type: 'bar',
                data: {
                    labels: dailyLabels,
                    datasets: [{
                        label: 'Daily Sales',
                        data: dailyValues,
                        backgroundColor: dailyGradient,
                        borderRadius: 14,
                        borderSkipped: false,
                        barThickness: 32
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    animation: {
                        duration: 2200,
                        easing: 'easeOutQuart',
                        delay: function (context) {
                            return context.dataIndex * 130;
                        }
                    },

                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#2B1B17',
                            titleColor: '#F5E6CA',
                            bodyColor: '#ffffff',
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: false
                        }
                    },

                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#8A7F78',
                                font: {
                                    weight: '700'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(111, 78, 55, 0.12)'
                            },
                            ticks: {
                                color: '#8A7F78'
                            }
                        }
                    }
                }
            });
        }

        if (categoryCanvas && typeof categoryLabels !== 'undefined') {
            if (window.categorySalesChartInstance) {
                window.categorySalesChartInstance.destroy();
            }

            window.categorySalesChartInstance = new Chart(categoryCanvas, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        data: categoryValues,
                        backgroundColor: [
                            '#6F4E37',
                            '#C9A66B',
                            '#2B1B17',
                            '#8A7F78',
                            '#F5E6CA',
                            '#B88A5A'
                        ],
                        borderWidth: 4,
                        borderColor: '#ffffff',
                        hoverOffset: 16
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',

                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 3500,
                        easing: 'easeOutQuart'
                    },

                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#2B1B17',
                                padding: 16,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    weight: '700'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#2B1B17',
                            titleColor: '#F5E6CA',
                            bodyColor: '#ffffff',
                            padding: 12,
                            cornerRadius: 12
                        }
                    }
                }
            });
        }

    }, 300);
});