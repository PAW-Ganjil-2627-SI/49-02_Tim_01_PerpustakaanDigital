<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ID Card - {{ $member->nama }}</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: #f4f7fb;
      font-family: "Segoe UI", Arial, Helvetica, sans-serif;
      color: #1e293b;
      padding: 20px;
    }
    .id-card {
      width: 380px;
      max-width: 100%;
      border: 2px solid #0284c7;
      border-radius: 12px;
      overflow: hidden;
      background: #ffffff;
      box-shadow: 0 10px 26px rgba(15, 23, 42, 0.12);
    }
    .id-header {
      background: #0284c7;
      color: #ffffff;
      padding: 14px 16px;
      text-align: center;
    }
    .id-header h2 {
      margin: 0 0 2px;
      font-size: 16px;
      letter-spacing: 0.4px;
    }
    .id-header small {
      opacity: 0.9;
      font-size: 12px;
    }
    .id-body {
      padding: 18px 20px;
      font-size: 14px;
      line-height: 1.65;
    }
    .id-body p {
      margin: 4px 0;
    }
    .id-footer {
      background: #f8fafc;
      border-top: 1px solid #dce5f0;
      text-align: center;
      padding: 10px;
      font-size: 12px;
      color: #64748b;
    }
    .no-print {
      margin-top: 16px;
      display: flex;
      gap: 10px;
    }
    .btn-print {
      background-color: #16a34a;
      color: #ffffff;
      border: none;
      padding: 9px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
    }
    .btn-print:hover { background-color: #15803d; }
    .btn-back {
      background-color: #64748b;
      color: #ffffff;
      text-decoration: none;
      padding: 9px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
    }
    .btn-back:hover { background-color: #475569; }
    @media print {
      body { background: #ffffff; }
      .id-card { box-shadow: none; }
      .no-print { display: none; }
    }
  </style>
</head>
<body>
  <div class="id-card">
    <div class="id-header">
      <h2>KARTU ANGGOTA PERPUSTAKAAN</h2>
      <small>Perpustakaan Digital</small>
    </div>
    <div class="id-body">
      <p><strong>No. Kartu:</strong> {{ $member->nomor_kartu }}</p>
      <p><strong>Nama:</strong> {{ $member->nama }}</p>
      <p><strong>Status:</strong> {{ $member->tipe_keanggotaan }}</p>
      <p><strong>Email:</strong> {{ $member->email }}</p>
      <p><strong>No. HP:</strong> {{ $member->no_hp }}</p>
    </div>
    <div class="id-footer">
      Berlaku Selama Menjadi Anggota
    </div>
  </div>

  <div class="no-print">
    <button type="button" onclick="window.print()" class="btn-print">Print / Simpan PDF</button>
    <a href="{{ route('members.index') }}" class="btn-back">Kembali</a>
  </div>
</body>
</html>
