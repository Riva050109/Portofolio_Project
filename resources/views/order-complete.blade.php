<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan | Brand Anda</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #3b82f6;
        --primary-light: #60a5fa;
        --success: #10b981;
        --dark: #1e293b;
        --gray-dark: #64748b;
        --gray-light: #f1f5f9;
        --white: #ffffff;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        color: var(--dark);
        line-height: 1.6;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .header {
        background-color: var(--white);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 20px 0;
    }

    .logo {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
        flex: 1;
    }

    .confirmation-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        position: relative;
    }

    .confirmation-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 40px;
        color: var(--white);
        text-align: center;
    }

    .confirmation-icon {
        width: 100px;
        height: 100px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .confirmation-icon svg {
        width: 50px;
        height: 50px;
    }

    h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .confirmation-subtitle {
        font-size: 18px;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .confirmation-body {
        padding: 40px;
    }

    .order-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .summary-card {
        background: var(--gray-light);
        border-radius: 12px;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .summary-card:hover {
        transform: translateY(-5px);
    }

    .summary-title {
        font-size: 14px;
        color: var(--gray-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .summary-value {
        font-size: 20px;
        font-weight: 600;
        color: var(--dark);
    }

    .order-details {
        background: var(--gray-light);
        border-radius: 12px;
        padding: 30px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid rgba(100, 116, 139, 0.1);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: var(--gray-dark);
    }

    .detail-value {
        font-weight: 500;
        text-align: right;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-badge.pending {
        background-color: #ffedd5;
        color: #9a3412;
    }

    .status-badge.completed {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-badge svg {
        width: 16px;
        height: 16px;
        margin-right: 6px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: var(--white);
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin-top: 30px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
    }

    .btn svg {
        width: 20px;
        height: 20px;
        margin-right: 8px;
    }

    .footer {
        text-align: center;
        padding: 30px 0;
        color: var(--gray-dark);
        font-size: 14px;
    }

    .timestamp {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        margin-top: 10px;
    }

    @media (max-width: 768px) {
        .confirmation-header {
            padding: 30px 20px;
        }

        .confirmation-body {
            padding: 30px 20px;
        }

        .order-summary {
            grid-template-columns: 1fr;
        }
    }
    </style>
</head>

<body>
    <main class="container">
        <div class="confirmation-card">
            <div class="confirmation-header">
                <div class="confirmation-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1>Terima Kasih Atas Pesanan Anda!</h1>
                <p class="confirmation-subtitle">Pesanan Anda #{{ $order->id }} telah kami terima</p>
                <div class="timestamp">
                    Dipesan pada {{ $order->created_at->format('j F Y \p\u\k\u\l H:i') }}
                </div>
            </div>

            <div class="confirmation-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="order-summary">
                    <div class="summary-card">
                        <div class="summary-title">Nomor Pesanan</div>
                        <div class="summary-value">#{{ $order->id }}</div>
                    </div>

                    <div class="summary-card">
                        <div class="summary-title">Total Pembayaran</div>
                        <div class="summary-value">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</div>
                    </div>

                    <div class="summary-card">
                        <div class="summary-title">Status Pesanan</div>
                        <div class="summary-value">
                            <span class="status-badge {{ $order->status === 'completed' ? 'completed' : 'pending' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    @if($order->status === 'completed')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    @endif
                                </svg>
                                {{ $order->status === 'completed' ? 'Selesai' : 'Dalam Proses' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="order-details">
                    <h3 style="margin-top: 0; margin-bottom: 20px;">Detail Pesanan</h3>

                    <div class="detail-item">
                        <span class="detail-label">Metode Pembayaran</span>
                        <span class="detail-value">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Alamat Pengiriman</span>
                        <span class="detail-value">{{ $order->address }}, {{ $order->city }},
                            {{ $order->postal_code }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Perkiraan Pengiriman</span>
                        <span class="detail-value">
                            {{ $order->created_at->addDays(3)->format('j F Y') }} -
                            {{ $order->created_at->addDays(5)->format('j F Y') }}
                        </span>
                    </div>
                </div>

                <p style="text-align: center; margin-top: 30px; color: var(--gray-dark);">
                    Kami telah mengirim email konfirmasi ke alamat email Anda.
                    Anda akan menerima email lagi ketika pesanan dikirim.
                </p>

                <div style="text-align: center;">
                    <a href="{{ route('home') }}" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>© {{ date('Y') }} Brand Anda. Semua hak dilindungi.</p>
            <p>Butuh bantuan? <a href="mailto:support@brandanda.com" style="color: var(--primary);">Hubungi tim dukungan
                    kami</a></p>
        </div>
    </footer>
</body>

</html>