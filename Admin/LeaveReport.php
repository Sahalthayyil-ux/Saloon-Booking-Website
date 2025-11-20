<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Saloonlist</title>

<style>
  /* Color palette: red, white, black */
  :root{
    --red: #1616eb;
    --black: #0b0b0b;
    --white: #ffffff;
    --muted-black: #2b2b2b;
  }

  *{ box-sizing: border-box; margin:0; padding:0; font-family: "Segoe UI", Roboto, Arial, sans-serif; }

  body{
    background: var(--white);
    color: var(--black);
    /* padding: 28px; */
  }

  .container{ max-width: 100%; margin: 0 auto; }

  .page-header{
    display:flex; align-items:center; justify-content:space-between;
    gap:16px; margin-bottom:18px;
  }
  .page-title{ display:flex; align-items:center; gap:12px; }
  .page-title h1{ font-size:24px; color:var(--black); }
  .page-title .dot{
    width:14px; height:14px; background:var(--red);
    border-radius:50%; box-shadow: 0 0 0 4px rgba(193,0,0,0.06);
  }

  .card{
    border-radius: 10px;
    border: 2px solid var(--red);
    overflow: hidden;
    background: var(--white);
    box-shadow: 0 6px 18px rgba(11,11,11,0.06);
  }
  .card-header{
    background: var(--red);
    color: var(--white);
    padding: 12px 16px;
    font-weight:600;
    display:flex; justify-content:space-between;
  }
  .card-header .sub{ font-size:14px; opacity:0.95; }

  table{
    border-collapse:collapse;
    font-size:14px;
    min-width: 1000px; /* ensures horizontal scroll if content is wide */
  }
  thead th{
    text-align:left; padding:12px 14px;
    background: var(--black); color:var(--white);
    font-weight:700; letter-spacing:0.3px;
    border-right: 1px solid rgba(255,255,255,0.06);
  }
  thead th:last-child{ border-right: none; }

  tbody tr{ border-bottom:1px solid rgba(11,11,11,0.06); transition: background .15s ease; }
  tbody tr:nth-child(even){ background: rgba(193,0,0,0.03); }
  tbody tr:hover{ background: rgba(193,0,0,0.06); }
  tbody td{ padding:12px 14px; vertical-align: middle; color:var(--muted-black); }

  td.sino{ width:56px; text-align:center; font-weight:600; color:var(--black); }

  td{ white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  td.address{ max-width:200px; white-space:normal; }

  .thumb{
    width:110px; height:110px; border-radius:8px; overflow:hidden;
    border:2px solid rgba(11,11,11,0.06); background:var(--white);
  }
  .thumb img{ width:100%; height:100%; object-fit:cover; }

  .action-link{
    padding:8px 12px; border-radius:8px;
    background:var(--black); color:var(--white); text-decoration:none;
    font-weight:600; border: 2px solid var(--black);
    transition: transform .08s ease, background .12s;
  }
  .action-link:hover{ transform: translateY(-2px); background: var(--red); border-color: var(--red); }

  /* Scrollable wrapper */
  .table-wrap.table-scroll {
    max-height: 400px;       /* vertical scroll */
    overflow-y: auto;
    overflow-x: auto;        /* horizontal scroll */
    display: block;
    width: 100%;
  }
  .table-wrap.table-scroll table { width:100%; table-layout: fixed; }
  .table-wrap.table-scroll thead,
  .table-wrap.table-scroll tbody tr {
    display: table;
    width: 155%;
    table-layout: fixed;
  }
  .table-wrap.table-scroll thead {
    position: sticky;
    top: 0;
    z-index: 2;
  }

  .footer-note{
    padding:10px 12px; text-align:right;
    color:var(--muted-black); font-size:13px;
    background:linear-gradient(180deg, rgba(0,0,0,0.02), transparent);
  }
</style>
</head>

<body>
<div class="container">
  <div class="page-header">
    <div class="page-title">
      <div class="dot"></div>
      <h1>Saloon List</h1>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div id="saloon-list">Active saloons</div>
    </div>

    <div class="table-wrap table-scroll">
      <table>
        <thead>
          <tr>
            <th>SINO</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CONTACT</th>
            <th>OWNERNAME</th>
            <th>GSTNO</th>
            <th>ADDRESS</th>
            <th>LOGO</th>
            <th>PROOF</th>
            <th>STATE</th>
            <th>DISTRICT</th>
            <th>PLACE</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        $sel="SELECT * FROM tbl_saloon u 
               INNER JOIN tbl_place p ON u.place_id=p.place_id 
               INNER JOIN tbl_district d ON p.district_id=d.district_id 
               INNER JOIN tbl_state s ON d.state_id=s.state_id 
               WHERE saloon_status='1'";
        $row = $con->query($sel);
        while($data = $row->fetch_assoc()){ $i++; ?>
          <tr>
            <td class="sino"><?php echo $i; ?></td>
            <td><?php echo htmlspecialchars($data["saloon_name"]);?></td>
            <td><?php echo htmlspecialchars($data["saloon_email"]);?></td>
            <td><?php echo htmlspecialchars($data["saloon_contact"]);?></td>
            <td><?php echo htmlspecialchars($data["saloon_ownername"]);?></td>
            <td><?php echo htmlspecialchars($data["saloon_gstno"]);?></td>
            <td class="address"><?php echo nl2br(htmlspecialchars($data["saloon_address"]));?></td>
            <td>
              <div class="thumb">
                <img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"] ?: 'default-logo.png';?>" alt="logo">
              </div>
            </td>
            <td>
              <div class="thumb">
                <img src="../Assets/Files/User/proof/<?php echo $data["saloon_proof"] ?: 'default-proof.png';?>" alt="proof">
              </div>
            </td>
            <td><?php echo htmlspecialchars($data["state_name"]);?></td>
            <td><?php echo htmlspecialchars($data["district_name"]);?></td>
            <td><?php echo htmlspecialchars($data["place_name"]);?></td>
            <td>
              <a class="action-link" href="LeaveList.php?sid=<?php echo $data['saloon_id'] ?>">View Leave List</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="footer-note">
      Total records: <?php echo intval($i); ?>
    </div>
  </div>
</div>
</body>
</html>

<?php
include('Footer.php');
?>
