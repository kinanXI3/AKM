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

                    {{-- Tanggal & Filter --}}
                    <div class="flex justify-between items-center mb-8">
                        <div class="flex items-center space-x-2 text-lg font-medium">
                            <i class="fa-solid fa-calendar-days text-gray-200"></i>
                            <span id="tanggal-terpilih">23 September 2025</span>
                        </div>
                        <button id="btn-filter" class="flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                            <i class="fa-solid fa-filter mr-2"></i>
                            Filter Berdasarkan Tanggal
                        </button>
                        <input type="text" id="datepicker" class="hidden">
                    </div>

                    {{-- Chart --}}
                    <div class="flex justify-center mb-8">
                        <div class="w-[600px] h-[420px]">
                            <canvas id="chartKunjungan" width="700" height="420"></canvas>
                        </div>
                    </div>

                    {{-- Persen --}}
                    <div id="legend-metode" class="flex justify-center space-x-10 mb-8">
                        <div class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-gray-400 block rounded"></span>
                            <span>QR (30%)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-gray-700 block rounded"></span>
                            <span>RFID (70%)</span>
                        </div>
                    </div>

                    {{-- Statistik ringkas --}}
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-users text-gray-200"></i>
                            <span>Total Pengunjung: <strong>271 orang</strong></span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-user-graduate text-gray-200"></i>
                            <span>Mahasiswa: <strong>250</strong></span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-person-walking text-gray-200"></i>
                            <span>Tamu / Non-mahasiswa: <strong>21</strong></span>
                        </div>
                    </div>

                    {{-- Grafik lainnya --}}
                    <div class="flex justify-center space-x-4">
                        <button id="btn-metode" class="chart-btn flex items-center px-4 py-2 bg-gray-700 text-white rounded shadow">
                            <i class="fa-solid fa-chart-pie mr-2"></i> Metode
                        </button>
                        <button id="btn-jurusan" class="chart-btn flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                            <i class="fa-solid fa-chart-column mr-2"></i> Jurusan
                        </button>
                        <button id="btn-hari" class="chart-btn flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                            <i class="fa-solid fa-chart-line mr-2"></i> Hari/Bulan
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script: Chart.js + Flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script>
        const ctx = document.getElementById('chartKunjungan').getContext('2d');
        let currentChart;

        // Data
        const dataMetode = {
            labels: ['QR', 'RFID'],
            datasets: [{
                data: [30, 70],
                backgroundColor: ['#d1d5db', '#374151'],
            }]
        };

        const dataJurusan = {
            labels: ['TI', 'SI', 'DKV', 'AK', 'MI'],
            datasets: [{
                label: 'Jumlah',
                data: [120, 80, 40, 20, 11],
                backgroundColor: ['#d1d5db', '#9ca3af', '#6b7280', '#4b5563', '#374151']
            }]
        };

        const dataHari = {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
            datasets: [{
                label: 'Kunjungan',
                data: [50, 70, 65, 90, 80],
                borderColor: '#374151',
                backgroundColor: '#374151',
                fill: false,
                tension: 0.4
            }]
        };

        // Render default (Metode)
        function renderChart(type) {
            if (currentChart) currentChart.destroy();

            if (type === 'metode') {
                currentChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: dataMetode,
                    options: { cutout: '70%', plugins: { legend: { display: false } }, maintainAspectRatio: false }
                });
                document.getElementById('legend-metode').classList.remove('hidden');
            }
            else if (type === 'jurusan') {
                currentChart = new Chart(ctx, {
                    type: 'bar',
                    data: dataJurusan,
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } },
                        maintainAspectRatio: false // Tambahkan ini
                    }
                });
                document.getElementById('legend-metode').classList.add('hidden');
            }
            else if (type === 'hari') {
            currentChart = new Chart(ctx, {
                type: 'line',
                data: dataHari,
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } },
                    maintainAspectRatio: false // Tambahkan ini
                }
            });
            document.getElementById('legend-metode').classList.add('hidden');
        }
    }

        // Event tombol
        function setActive(btnId) {
            document.querySelectorAll('.chart-btn').forEach(b => {
                b.classList.remove('bg-gray-700', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            const btn = document.getElementById(btnId);
            btn.classList.remove('bg-gray-200', 'text-gray-700');
            btn.classList.add('bg-gray-700', 'text-white');
        }

        document.getElementById('btn-metode').addEventListener('click', () => {
            renderChart('metode'); setActive('btn-metode');
        });
        document.getElementById('btn-jurusan').addEventListener('click', () => {
            renderChart('jurusan'); setActive('btn-jurusan');
        });
        document.getElementById('btn-hari').addEventListener('click', () => {
            renderChart('hari'); setActive('btn-hari');
        });

        renderChart('metode'); // default

        // Flatpickr
        const dateInput = document.getElementById("datepicker");
        const tanggalTeks = document.getElementById("tanggal-terpilih");
        flatpickr(dateInput, {
            dateFormat: "d F Y",
            defaultDate: "today",
            onChange: function(selectedDates, dateStr) {
                tanggalTeks.textContent = dateStr;
            }
        });
        document.getElementById("btn-filter").addEventListener("click", function() {
            dateInput._flatpickr.open();
        });
    </script>
</x-app-layout>
