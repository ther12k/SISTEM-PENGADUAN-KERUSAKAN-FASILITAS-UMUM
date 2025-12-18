<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            /* Background gradient sedikit lebih biru/cool untuk nuansa keamanan */
            background: linear-gradient(135deg, #e0eaFC 0%, #cfdef3 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }

        /* Hiasan background bulat */
        .circle {
            position: absolute;
            background: rgba(74, 105, 189, 0.05); /* Warna hiasan jadi kebiruan */
            border-radius: 50%;
            z-index: 0;
        }
        .c1 { width: 180px; height: 180px; top: -60px; left: -60px; }
        .c2 { width: 120px; height: 120px; bottom: -40px; right: -40px; background: rgba(235, 77, 75, 0.05); }

        .content {
            position: relative;
            z-index: 1;
        }

        /* --- BAGIAN IKON --- */
        .angry-icon {
            font-size: 85px; /* Ukuran pas untuk 2 emoji */
            margin: 0 auto 15px;
            display: inline-block;
            /* Animasi getar */
            animation: angry-shake 0.8s infinite ease-in-out;
            /* Shadow halus */
            filter: drop-shadow(0 5px 10px rgba(0,0,0, 0.2));
            cursor: default;
        }

        h1 {
            font-size: 2.5rem;
            color: #2f3542;
            margin-bottom: 10px;
            font-weight: 800;
        }

        p {
            color: #57606f;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-home {
            background: #ff4757; /* Tetap merah untuk sinyal 'Stop/Alert' */
            color: white;
            text-decoration: none;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
            display: inline-block;
        }

        .btn-home:hover {
            background: #2f3542;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(47, 53, 66, 0.3);
        }

        /* Keyframe Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animasi Getar (Seperti menahan/menyuruh stop) */
        @keyframes angry-shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="circle c1"></div>
        <div class="circle c2"></div>

        <div class="content">
            <div class="angry-icon">
                👮‍♀⛔
            </div>

            <h1>Akses Ditolak!</h1>
            <p>Eits, tunggu dulu! Area ini dibatasi.<br>Mohon tunjukkan surat izin atau silakan putar balik.</p>
            
            <a href="<?= base_url('/') ?>" class="btn-home">Siap, Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>