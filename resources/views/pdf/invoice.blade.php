<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $booking->id }}</title>
    <style>
        @media print {
            @page { margin: 0; size: auto; }
            body { margin: 1.6cm; }
            .no-print { display: none; }
        }
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.6;
            background: #f0f0f0; /* Background for screen */
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 210mm; /* A4 width */
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            min-height: 297mm; /* A4 height */
            box-sizing: border-box;
        }
        /* ... existing styles ... */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #74A6AF;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #74A6AF;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .invoice-title {
            font-size: 18px;
            margin-top: 10px;
            color: #555;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table th, .details-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .details-table th {
            background-color: #f9f9f9;
            color: #555;
            font-weight: bold;
        }
        .total-row td {
            font-size: 18px;
            font-weight: bold;
            color: #74A6AF;
            border-top: 2px solid #74A6AF;
        }
        .qr-section {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border: 1px dashed #ccc;
            background-color: #fcfcfc;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
        .qr-code {
            width: 150px;
            height: 150px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #999;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .print-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background: #333;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        .print-btn:hover {
            background: #000;
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-btn no-print">🖨️ Print / Save as PDF</button>

    <div class="container">
        <div class="header">
            <div class="logo">Coralwind Suites</div>
            <div class="invoice-title">Official Receipt</div>
            <p>Jl. Pantai Indah No. 88, Bali | (021) 123-4567</p>
        </div>

        <table class="details-table">
            <tr>
                <th>Booking ID</th>
                <td>#{{ $booking->id }}</td>
            </tr>
            <tr>
                <th>Guest Name</th>
                <td>{{ $booking->user->name }}</td>
            </tr>
            <tr>
                <th>Room Type</th>
                <td>{{ $booking->room->nama_kamar }} ({{ $booking->room->tipe_kamar }})</td>
            </tr>
            <tr>
                <th>Check-in</th>
                <td>{{ $booking->tgl_check_in->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Check-out</th>
                <td>{{ $booking->tgl_check_out->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Duration</th>
                <td>{{ $booking->tgl_check_in->diffInDays($booking->tgl_check_out) }} Nights</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="status-badge" style="background-color: {{ $booking->status == 'selesai' ? '#d1fae5' : '#fef3c7' }}; color: {{ $booking->status == 'selesai' ? '#065f46' : '#92400e' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
            </tr>
            <tr class="total-row">
                <td>Total Paid</td>
                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="qr-section">
            <p style="margin-top: 0; font-size: 12px; color: #777;">Scan to Verify Check-in</p>
            <img src="{{ $qrcode }}" class="qr-code" alt="QR Code">
        </div>

        <div class="footer">
            <p>Thank you for choosing Coralwind Suites.</p>
            <p>Generated on {{ now()->format('d M Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
