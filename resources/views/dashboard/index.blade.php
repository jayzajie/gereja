@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .calendar-widget {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .calendar-header {
        background: linear-gradient(135deg, #D4A574 0%, #C8956D 100%);
        color: white;
        border-bottom: 1px solid #e0e0e0;
    }

    .pie-chart-container {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .calendar-grid .row {
        margin: 0;
    }

    .calendar-grid .col {
        padding: 5px;
        text-align: center;
        border: 1px solid #f0f0f0;
        min-height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .calendar-grid .col:hover {
        background-color: #f8f9fa;
    }

    .calendar-grid .col.today {
        background-color: #8B4513;
        color: white;
        font-weight: bold;
    }

    .calendar-grid .col.other-month {
        color: #ccc;
    }

    .calendar-day {
        cursor: pointer;
        transition: all 0.2s ease;
        border-radius: 4px;
        margin: 1px;
        position: relative;
    }

    .calendar-day:hover {
        background-color: #f8f9fa;
        transform: scale(1.05);
    }

    .calendar-day.today {
        background-color: #8B4513;
        color: white;
        font-weight: bold;
        box-shadow: 0 2px 8px rgba(139, 69, 19, 0.3);
        border-radius: 6px;
    }

    .calendar-day.selected {
        background-color: #D2B48C;
        color: #8B4513;
        font-weight: bold;
        border: 2px solid #8B4513;
        box-shadow: 0 2px 8px rgba(139, 69, 19, 0.2);
        border-radius: 6px;
    }

    .calendar-day.other-month {
        color: #ccc;
        cursor: default;
    }

    .calendar-day.other-month:hover {
        background-color: transparent;
        transform: none;
    }

    .calendar-header .btn-outline-light {
        border-color: rgba(255,255,255,0.3);
        color: white;
        transition: all 0.2s ease;
    }

    .calendar-header .btn-outline-light:hover {
        background-color: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.5);
        transform: scale(1.05);
    }

    .calendar-header .btn-light {
        background-color: white;
        border-color: white;
        color: #8B4513;
        font-weight: bold;
    }

    .calendar-day.has-event {
        background-color: #fff3cd;
        border: 1px solid #ffeaa7;
    }

    .calendar-day.has-event.today {
        background-color: #8B4513;
        color: white;
    }

    .calendar-day.has-event.selected {
        background-color: #D2B48C;
        border: 2px solid #8B4513;
    }

    .event-indicator {
        position: absolute;
        top: 2px;
        right: 2px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .calendar-day.today .event-indicator {
        background-color: #ffc107;
        color: #000;
    }

    /* Enhanced Responsive adjustments */
    @media (max-width: 1200px) {
        .stats-card {
            padding: 18px;
        }
        
        .calendar-widget {
            margin-bottom: 20px;
        }
    }
    
    @media (max-width: 992px) {
        .stats-card {
            padding: 16px;
            margin-bottom: 18px;
        }
        
        .stats-card .h5 {
            font-size: 1.15rem;
        }
        
        .pie-chart-container {
            padding: 18px;
        }
    }
    
    @media (max-width: 768px) {
        .stats-card {
            margin-bottom: 15px;
            padding: 15px;
        }
        
        .stats-card .h5 {
            font-size: 1.1rem;
        }
        
        .stats-card .fas {
            font-size: 1.5rem !important;
        }

        .pie-chart-container {
            margin-top: 20px;
            padding: 15px;
        }
        
        .calendar-widget .card-body {
            padding: 15px;
        }
        
        .calendar-grid .col {
            min-height: 30px;
            font-size: 0.875rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 10px;
        }
        
        .text-end {
            text-align: left !important;
        }
    }
    
    @media (max-width: 576px) {
        .stats-card {
            padding: 12px;
            margin-bottom: 12px;
        }
        
        .stats-card .text-xs {
            font-size: 0.7rem;
        }
        
        .stats-card .h5 {
            font-size: 1rem;
        }
        
        .stats-card .fas {
            font-size: 1.25rem !important;
        }
        
        .pie-chart-container {
            padding: 12px;
        }
        
        .pie-chart-container h5 {
            font-size: 1.1rem;
        }
        
        .calendar-widget .card-header {
            padding: 12px;
        }
        
        .calendar-widget .card-body {
            padding: 12px;
        }
        
        .calendar-grid .col {
            min-height: 25px;
            font-size: 0.75rem;
            padding: 2px;
        }
        
        .alert {
            padding: 8px 12px;
            font-size: 0.8rem;
        }
        
        .h1, .h3 {
            font-size: 1.5rem;
        }
        
        .container-fluid {
            padding: 0 10px;
        }
    }
    
    @media (max-width: 480px) {
        .stats-card .d-flex {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        
        .stats-card .col-auto {
            align-self: center;
        }
        
        .calendar-header .d-flex {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
        
        .calendar-header h5 {
            font-size: 1rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">📊 Dashboard Admin</h1>
                    <p class="mb-0 text-muted">Selamat datang di panel administrasi Gereja Toraja Eben-Haezer Selili</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Anggota</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $total_members ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <span style="font-size: 2rem; opacity: 0.75;">👥</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Anggota Aktif</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $active_members ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <span style="font-size: 2rem; opacity: 0.75;">✅</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pernikahan</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $total_marriages ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <span style="font-size: 2rem; opacity: 0.75;">💒</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Baptisan</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $total_baptisms ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <span style="font-size: 2rem; opacity: 0.75;">✝️</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Calendar Widget -->
        <div class="col-md-6 col-12 mb-4">
            <div class="card calendar-widget">
                <div class="card-header calendar-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kalender Kegiatan</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-light text-dark">Month</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info py-2 px-3 mb-3">
                        <small>
                            <span style="margin-right: 4px;">ℹ️</span>
                            <strong>Info:</strong> Kegiatan yang ditambahkan di kalender akan otomatis muncul di halaman utama website.
                        </small>
                    </div>
                    <div id="calendar-widget"></div>
                </div>
            </div>
        </div>

        <!-- Pie Chart Widget -->
        <div class="col-md-6 col-12 mb-4">
            <div class="pie-chart-container">
                <h5 class="mb-3">📈 Distribusi Status Anggota</h5>
                <div id="memberStatusChart"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calendar Widget
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = null;
    let viewMode = 'Month';

    // Event reminders storage
    let eventReminders = {};

    // Load events from database
    async function loadEvents() {
        try {
            const response = await fetch(`/api/public/calendar/events?year=${currentYear}&month=${currentMonth + 1}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                eventReminders = await response.json();
            }
        } catch (error) {
            console.error('Error loading events:', error);
        }
    }

    async function addEvent(date, title, description, time, category = 'general') {
        try {
            const response = await fetch('/api/calendar/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    title: title,
                    description: description,
                    event_date: date,
                    event_time: time,
                    category: category
                })
            });

            const result = await response.json();

            if (result.success) {
                // Add to local storage for immediate UI update
                if (!eventReminders[date]) {
                    eventReminders[date] = [];
                }
                eventReminders[date].push(result.event);
                return result.event;
            } else {
                throw new Error(result.message);
            }
        } catch (error) {
            console.error('Error adding event:', error);
            throw error;
        }
    }

    async function removeEvent(date, eventId) {
        try {
            const response = await fetch(`/api/calendar/events/${eventId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (result.success) {
                // Remove from local storage for immediate UI update
                if (eventReminders[date]) {
                    eventReminders[date] = eventReminders[date].filter(event => event.id !== eventId);
                    if (eventReminders[date].length === 0) {
                        delete eventReminders[date];
                    }
                }
            } else {
                throw new Error(result.message);
            }
        } catch (error) {
            console.error('Error removing event:', error);
            throw error;
        }
    }

    function getEventsForDate(date) {
        return eventReminders[date] || [];
    }

    function hasEvents(date) {
        return eventReminders[date] && eventReminders[date].length > 0;
    }

    const calendarWidget = document.getElementById('calendar-widget');

    async function renderCalendar() {
        if (!calendarWidget) return;

        // Load events from database
        await loadEvents();

        let calendarHTML = '<div class="calendar-grid">';

        // Month/Year header with navigation
        calendarHTML += '<div class="calendar-month-year text-center mb-3 d-flex justify-content-between align-items-center">';
        calendarHTML += '<button class="btn btn-sm btn-outline-secondary" onclick="previousMonth()">&lt;</button>';

        // Only Month view is supported now
        const headerText = new Date(currentYear, currentMonth).toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });

        calendarHTML += '<h6 class="mb-0">' + headerText + '</h6>';
        calendarHTML += '<button class="btn btn-sm btn-outline-secondary" onclick="nextMonth()">&gt;</button>';
        calendarHTML += '</div>';

        // Days of week header
        const daysOfWeek = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        calendarHTML += '<div class="row text-center mb-2">';
        daysOfWeek.forEach(day => {
            calendarHTML += '<div class="col"><small class="text-muted fw-bold">' + day + '</small></div>';
        });
        calendarHTML += '</div>';

            // Calendar days
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const today = new Date();

            let dayCount = 1;
            for (let week = 0; week < 6; week++) {
                calendarHTML += '<div class="row">';
                for (let day = 0; day < 7; day++) {
                    if (week === 0 && day < firstDay) {
                        // Previous month days
                        const prevMonth = new Date(currentYear, currentMonth, 0);
                        const prevDay = prevMonth.getDate() - (firstDay - day - 1);
                        calendarHTML += '<div class="col calendar-day other-month" data-date="' + (currentMonth === 0 ? currentYear - 1 : currentYear) + '-' + (currentMonth === 0 ? 12 : currentMonth) + '-' + prevDay + '">' + prevDay + '</div>';
                    } else if (dayCount <= daysInMonth) {
                        const isToday = dayCount === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear();
                        // Format date to match API response format (YYYY-MM-DD)
                        const dateKey = currentYear + '-' + String(currentMonth + 1).padStart(2, '0') + '-' + String(dayCount).padStart(2, '0');
                        const isSelected = selectedDate && selectedDate === dateKey;
                        const hasEvent = hasEvents(dateKey);

                        let classes = 'col calendar-day';
                        if (isToday) classes += ' today';
                        if (isSelected) classes += ' selected';
                        if (hasEvent) classes += ' has-event';

                        calendarHTML += '<div class="' + classes + '" data-date="' + dateKey + '" onclick="selectDate(this)">';
                        calendarHTML += '<span class="day-number">' + dayCount + '</span>';
                        if (hasEvent) {
                            const eventCount = getEventsForDate(dateKey).length;
                            calendarHTML += '<span class="event-indicator">' + eventCount + '</span>';
                        }
                        calendarHTML += '</div>';
                        dayCount++;
                    } else {
                        // Next month days
                        const nextDay = dayCount - daysInMonth;
                        calendarHTML += '<div class="col calendar-day other-month" data-date="' + (currentMonth === 11 ? currentYear + 1 : currentYear) + '-' + (currentMonth === 11 ? 1 : currentMonth + 2) + '-' + nextDay + '">' + nextDay + '</div>';
                        dayCount++;
                    }
                }
                calendarHTML += '</div>';
                if (dayCount > daysInMonth + 7) break;
            }

        calendarHTML += '</div>';
        calendarWidget.innerHTML = calendarHTML;
    }

    // Global functions for navigation
    window.previousMonth = async function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        await renderCalendar();
    };

    window.nextMonth = async function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        await renderCalendar();
    };

    window.selectDate = function(element) {
        // Remove previous selection
        document.querySelectorAll('.calendar-day.selected').forEach(el => {
            el.classList.remove('selected');
        });

        // Add selection to clicked date
        element.classList.add('selected');
        selectedDate = element.getAttribute('data-date');

        // Show event modal
        showEventModal(selectedDate);
    };

    function showEventModal(date) {
        const dateObj = new Date(date);
        const dateInfo = dateObj.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const events = getEventsForDate(date);

        let eventsHTML = '';
        if (events.length > 0) {
            eventsHTML = '<div class="mb-3"><h6>📅 Kegiatan Hari Ini:</h6>';
            events.forEach(event => {
                eventsHTML += `
                    <div class="event-item p-2 mb-2 border rounded">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong>${event.title}</strong>
                                ${event.time ? '<br><small class="text-muted">🕐 ' + event.time + '</small>' : ''}
                                ${event.description ? '<br><small>' + event.description + '</small>' : ''}
                            </div>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteEvent('${date}', ${event.id})">
                                🗑️
                            </button>
                        </div>
                    </div>
                `;
            });
            eventsHTML += '</div>';
        }

        const modalHTML = `
            <div class="modal fade" id="eventModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, #D2B48C 0%, #8B4513 100%); color: white;">
                            <h5 class="modal-title">📅 ${dateInfo}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            ${eventsHTML}

                            <h6>➕ Tambah Kegiatan Baru:</h6>
                            <form id="eventForm">
                                <div class="mb-3">
                                    <label class="form-label">📝 Judul Kegiatan</label>
                                    <input type="text" class="form-control" id="eventTitle" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">🕐 Waktu (Opsional)</label>
                                    <input type="time" class="form-control" id="eventTime">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">🏷️ Kategori</label>
                                    <select class="form-control" id="eventCategory">
                                        <option value="general">Umum</option>
                                        <option value="ibadah">Ibadah</option>
                                        <option value="kegiatan">Kegiatan</option>
                                        <option value="acara">Acara Khusus</option>
                                        <option value="rapat">Rapat</option>
                                        <option value="pelayanan">Pelayanan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">📄 Deskripsi (Opsional)</label>
                                    <textarea class="form-control" id="eventDescription" rows="3"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="saveEvent('${date}')">💾 Simpan Kegiatan</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Remove existing modal
        const existingModal = document.getElementById('eventModal');
        if (existingModal) {
            existingModal.remove();
        }

        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('eventModal'));
        modal.show();
    }

    window.saveEvent = async function(date) {
        const title = document.getElementById('eventTitle').value.trim();
        const time = document.getElementById('eventTime').value;
        const description = document.getElementById('eventDescription').value.trim();
        const category = document.getElementById('eventCategory') ? document.getElementById('eventCategory').value : 'general';

        if (!title) {
            alert('⚠️ Judul kegiatan harus diisi!');
            return;
        }

        try {
            // Add event to database
            await addEvent(date, title, description, time, category);

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('eventModal'));
            modal.hide();

            // Refresh calendar
            await renderCalendar();

            // Show success toast
            showToast('✅ Kegiatan berhasil ditambahkan!', 'success');
        } catch (error) {
            alert('❌ Terjadi kesalahan: ' + error.message);
        }
    };

    window.deleteEvent = async function(date, eventId) {
        if (confirm('🗑️ Apakah Anda yakin ingin menghapus kegiatan ini?')) {
            try {
                await removeEvent(date, eventId);

                // Refresh modal content
                showEventModal(date);

                // Refresh calendar
                await renderCalendar();

                // Show success toast
                showToast('🗑️ Kegiatan berhasil dihapus!', 'warning');
            } catch (error) {
                alert('❌ Terjadi kesalahan: ' + error.message);
            }
        }
    };

    function showToast(message, type = 'primary') {
        const bgClass = type === 'success' ? 'bg-success' : type === 'warning' ? 'bg-warning' : 'bg-primary';

        const toastHTML = `
            <div class="toast align-items-center text-white ${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;

        // Create toast container if it doesn't exist
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }

        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toast = new bootstrap.Toast(toastContainer.lastElementChild);
        toast.show();

        // Remove toast element after it's hidden
        toastContainer.lastElementChild.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }

    // View mode buttons (only Month mode now)
    document.addEventListener('click', function(e) {
        if (e.target.textContent === 'Month') {
            // Keep Month button active
            e.target.classList.remove('btn-outline-light');
            e.target.classList.add('btn-light', 'text-dark');

            viewMode = 'Month';
            renderCalendar();
        }
    });

    // Initial render
    renderCalendar();

    // Member Status Pie Chart
    const memberStatusChart = document.getElementById('memberStatusChart');
    if (memberStatusChart && typeof ApexCharts !== 'undefined') {
        const chartData = @json($member_status_distribution ?? ['approved' => 0, 'pending' => 0, 'rejected' => 0]);

        const options = {
            series: [chartData.approved || 0, chartData.pending || 0, chartData.rejected || 0, 5],
            chart: {
                type: 'pie',
                height: 300
            },
            labels: ['Aktif', 'Propose', 'Nia', 'Contra'],
            colors: ['#28a745', '#ffc107', '#dc3545', '#6c757d'],
            legend: {
                show: false
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return Math.round(val) + "%"
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        const chart = new ApexCharts(memberStatusChart, options);
        chart.render();
    }

    // Initialize calendar
    renderCalendar();
});
</script>
@endpush
