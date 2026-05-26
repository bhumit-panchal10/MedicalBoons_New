<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>INVOICE</title>
<style>
  :root{
    --ink:#1d2b4f;
    --muted:#6b7280;
    --line:#e5e7eb;
    --bg:#ffffff;
    --chip:#f3f4f6;
  }
  *{box-sizing:border-box}
  body{margin:0;font:14px/1.5 system-ui,-apple-system,Segoe UI,Roboto,Arial;background:#f6f7fb;color:#0f172a}
  .sheet{
    max-width:820px;margin:24px auto;background:var(--bg);
    border:2px solid var(--ink); border-radius:12px; overflow:hidden
  }
  .brand{
    padding:18px 22px; display:flex; align-items:center; justify-content:space-between; gap:16px;
    background:#fff;
  }
  .brand .logo{height:82px}
  .ribbon{
    background:linear-gradient(90deg,#1d2b4f 0%, #3a6c8e 100%);
    color:#fff; padding:12px 22px; display:flex; align-items:center; gap:10px; justify-content:center
  }
  .ribbon h1{margin:0;font-size:20px;letter-spacing:0.15em}
  .content{padding:24px}
  .grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
  .card{border:1px solid var(--line); border-radius:10px; padding:14px 16px; background:#fff}
  .title{font-weight:700; color:var(--ink); margin:0 0 6px 0; font-size:13px}
  .pair{display:grid; grid-template-columns:150px 1fr; gap:8px; margin:4px 0}
  .pair .k{color:var(--muted)}
  .pill{display:inline-block; background:var(--chip); border:1px solid var(--line); border-radius:999px; padding:4px 10px; font-size:12px}
  table{width:100%; border-collapse:collapse; margin-top:14px}
  th,td{padding:10px 12px; border-bottom:1px solid var(--line); vertical-align:top}
  thead th{background:#f9fafb; color:#111827; font-weight:700}
  tfoot td{border-top:1px solid var(--line)}
  .right{text-align:right}
  .mono{font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace}
  .muted{color:var(--muted)}
  .total-row td{font-weight:800; color:var(--ink); border-top:2px solid var(--ink)}
  .foot{
    border-top:1px solid var(--line); background:#f9fafb; color:#94a3b8; text-align:center;
    padding:14px
  }
  .fine{font-size:12px}
  @media print{
    body{background:#fff}
    .sheet{border:none; border-radius:0; box-shadow:none}
    .foot{color:#6b7280}
  }
</style>
</head>
<body>
  <section class="sheet">
    <!-- Header -->
    <div class="brand">
      <img class="logo" src="https://medicalboons.com/assets/images/Front/new-logo-color.png" alt="Logo">
      <span class="pill mono">MEDICALBOONS INVOICE</span>
    </div>

    <!-- Big title -->
    <div class="ribbon">
      <h1>I N V O I C E</h1>
    </div>

    <div class="content">
      <!-- Top meta -->
      <div class="grid">
        <div class="card">
          <p class="title">Invoice Details</p>
          <div class="pair"><div class="k">Invoice No.:</div><div class="v mono">{{ $CorporateOrder->invoice_no ?? 'RBH2324/13865' }}</div></div>
          <div class="pair"><div class="k">Invoice Date:</div><div class="v">{{ date('d-m-y',strtotime($CorporateOrder->created_at)) ?? 'March 16, 2024, 5:25 p.m.' }}</div></div>
          <div class="pair"><div class="k">Order No.:</div><div class="v mono">{{ $CorporateOrder->Corporate_Order_id ?? '141373' }}</div></div>
        </div>
        <div class="card">
          <p class="title">Billing To</p>
          <div class="pair"><div class="k">Proposer Name:</div><div class="v">{{ $CorporateOrder->Name ?? 'Pritesh J Shah' }}</div></div>
          <div class="pair"><div class="k">Billing Address:</div>
            <div class="v">
              {{ $CorporateOrder->address ?? '9/52, Sonalpark, Opp Vijaynagar Bus Stand, Naranpura, Ahmedabad, Gujarat, 380013' }}
            </div>
          </div>
          <!-- <div class="pair"><div class="k">GST No:</div><div class="v mono">{{ $gst_no ?? '-' }}</div></div> -->
        </div>
      </div>

      <!-- Items -->
      <table>
        <thead>
          <tr>
            <th style="width:60%">Item &amp; Particular</th>
            <th class="right" style="width:20%">SAC</th>
            <th class="right" style="width:20%">Amount (₹)</th>
          </tr>
        </thead>
        <tbody>
          <!-- Repeat for each line item -->
          <tr>
            <td>{{ $CorporateOrder->plan->name ?? 'RenewBuy Health Wellness' }}</td>
            <td class="right mono"></td>
            <td class="right mono">{{ $CorporateOrder->plan->amount ?? '508.47' }}</td>
          </tr>
        </tbody>
        <tfoot>
          <!-- <tr>
            <td class="right" colspan="2">IGST (18%)</td>
            <td class="right mono">{{ $igst ?? '91.52' }}</td>
          </tr> -->
          <!-- <tr>
            <td class="right muted fine" colspan="2">CGST (9%)</td>
            <td class="right mono muted fine">{{ $cgst ?? '—' }}</td>
          </tr> -->
          <!-- <tr>
            <td class="right muted fine" colspan="2">SGST (9%)</td>
            <td class="right mono muted fine">{{ $sgst ?? '—' }}</td>
          </tr> -->
          <tr class="total-row">
            <td class="right" colspan="2">Total</td>
            <td class="right mono">{{ $CorporateOrder->plan->amount ?? '600.00' }}</td>
          </tr>
        </tfoot>
      </table>

      <!-- Footer note -->
      <p class="fine muted" style="margin-top:18px">
        This is a system generated invoice, signature is not required.
      </p>

      <!-- Registered office -->
      <div class="card" style="margin-top:12px">
        <div class="fine muted">
          <div><strong>REGISTERED OFFICE ADDRESS</strong> — C-2, Rajkamal Plaza -A, Nr C U Shah College,
Income Tax, Ashram Road, Ahmedabad. Gujarat,India</div>
          <!-- <div class="fine" style="margin-top:6px">
            CIN: U74999HR2021PTC098232 &nbsp;|&nbsp; GST: 06AALCR3418B1ZO &nbsp;|&nbsp; PAN: AALCR3418B
          </div> -->
        </div>
      </div>
    </div>

    <div class="foot fine">
      &copy; {{ date('Y') }} MedicalBoons. All rights reserved.
    </div>
  </section>
</body>
</html>
