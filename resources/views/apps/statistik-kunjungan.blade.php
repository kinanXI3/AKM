<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statistik Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Statistik ringkas --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 text-center">
                        <div class="bg-[#40E0D0]/20 rounded-lg py-4 shadow-md">
                            <h3 class="text-lg font-semibold">Hari Ini</h3>
                            <p id="totalHariIni" class="text-3xl font-bold mt-2">0</p>
                        </div>
                        <div class="bg-[#40E0D0]/30 rounded-lg py-4 shadow-md">
                            <h3 class="text-lg font-semibold">Bulan Ini</h3>
                            <p id="totalBulanIni" class="text-3xl font-bold mt-2">0</p>
                        </div>
                        <div class="bg-[#40E0D0]/40 rounded-lg py-4 shadow-md">
                            <h3 class="text-lg font-semibold">Keseluruhan</h3>
                            <p id="totalKeseluruhan" class="text-3xl font-bold mt-2">0</p>
                        </div>
                    </div>

                    {{-- Grafik Metode --}}
                    <div class="flex justify-center mb-10">
                        <div class="w-full sm:w-[600px] h-[400px]">
                            <canvas id="chartKunjungan"></canvas>
                        </div>
                    </div>

                    {{-- Persentase Metode --}}
                    <div id="legend-metode" class="flex flex-wrap justify-center gap-6 text-sm">
                        {{-- Dinamis dari JS --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('chartKunjungan').getContext('2d');
        let chartKunjungan;

        async function loadData() {
            const res = await fetch("{{ route('statistik.data') }}");
            const data = await res.json();

            // Update statistik ringkas
            document.getElementById('totalHariIni').textContent = data.totalHariIni;
            document.getElementById('totalBulanIni').textContent = data.totalBulanIni;
            document.getElementById('totalKeseluruhan').textContent = data.totalKeseluruhan;

            // Update chart
            const labels = data.chart.labels;
            const totals = data.chart.data;

            if (chartKunjungan) chartKunjungan.destroy();

            chartKunjungan = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: totals,
                        borderColor: '#40E0D0',
                        backgroundColor: 'rgba(64, 224, 208, 0.3)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true }
                    },
                    maintainAspectRatio: false
                }
            });

            // Update legend metode
            const legendContainer = document.getElementById('legend-metode');
            legendContainer.innerHTML = '';
            data.metodeStats.forEach(item => {
                legendContainer.innerHTML += `
                    <div class="flex items-center space-x-2">
                        <span class="w-4 h-4 bg-[#40E0D0] rounded"></span>
                        <span>${item.metode}: ${item.total}</span>
                    </div>
                `;
            });
        }

        loadData();
    </script>
</x-app-layout>
