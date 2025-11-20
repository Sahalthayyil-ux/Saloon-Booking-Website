<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User List</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        color: #000;
        /* padding: 20px; */
    }
    
    .container {
        max-width: 1400px;
        margin: 0 auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        padding: 30px;
        overflow: hidden;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        color: #000;
        font-size: 28px;
        position: relative;
        padding-bottom: 15px;
        font-weight: bold;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: #1616eb;
        border-radius: 2px;
    }
    
    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    .data-table th,
    .data-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }
    
    .data-table th {
        background-color: #000;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: sticky;
        top: 0;
    }
    
    .data-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .data-table tr:hover {
        background-color: #ffeeee;
    }
    
    .user-photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
        transition: all 0.3s;
    }
    
    .user-photo:hover {
        border-color: #1616eb;
        transform: scale(1.05);
    }
    
    .no-data {
        text-align: center;
        padding: 30px;
        color: #666;
        font-style: italic;
    }
    
    .stats-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
        flex: 1;
        min-width: 200px;
        margin: 0 10px 10px 0;
        border-top: 4px solid #1616eb;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #1616eb;
        margin-bottom: 5px;
    }
    
    .stat-label {
        color: #000;
        font-weight: 600;
    }
    
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .search-box {
        display: flex;
        align-items: center;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px 15px;
        margin-right: 10px;
    }
    
    .search-input {
        border: none;
        outline: none;
        padding: 8px;
        font-size: 16px;
        background: transparent;
        color: #000;
        width: 250px;
    }
    
    .search-btn {
        background: #1616eb;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .search-btn:hover {
        background: #0f0f8aff;
    }
    
    .filter-select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: white;
        color: #000;
        margin-right: 10px;
    }
    
    @media (max-width: 1200px) {
        .container {
            padding: 15px;
        }
        
        .data-table {
            font-size: 14px;
        }
        
        .data-table th,
        .data-table td {
            padding: 10px;
        }
        
        .stat-card {
            min-width: 150px;
        }
    }
    
    @media (max-width: 768px) {
        .stats-container {
            flex-direction: column;
        }
        
        .stat-card {
            margin: 0 0 10px 0;
        }
        
        .action-bar {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-box {
            margin: 0 0 10px 0;
            width: 100%;
        }
        
        .search-input {
            width: 100%;
        }
        
        .data-table {
            font-size: 12px;
        }
        
        .data-table th,
        .data-table td {
            padding: 8px;
        }
        
        .user-photo {
            width: 60px;
            height: 60px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h1 class="page-title">User Management</h1>
    
    <?php
    // Get user count
    $countQuery = "SELECT COUNT(*) as total_users FROM tbl_user";
    $countResult = $con->query($countQuery);
    $userCount = $countResult->fetch_assoc()['total_users'];
    ?>
    
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number"><?php echo $userCount; ?></div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo date('M Y'); ?></div>
            <div class="stat-label">Current Period</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo date('H:i'); ?></div>
            <div class="stat-label">Last Updated</div>
        </div>
    </div>
    
    <div class="action-bar">
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Search users..." id="searchInput">
            <button class="search-btn" onclick="searchUsers()">
                <i class="fas fa-search"></i>
            </button>
        </div>
        
        <div>
            <!-- <select class="filter-select" id="sortSelect" onchange="sortTable()">
                <option value="">Sort by</option>
                <option value="name">Name</option>
                <option value="state">State</option>
                <option value="district">District</option>
            </select> -->
            
            <select class="filter-select" id="rowsSelect" onchange="changeRowsPerPage()">
                <option value="10">10 rows</option>
                <option value="25">25 rows</option>
                <option value="50">50 rows</option>
                <option value="100">100 rows</option>
            </select>
        </div>
    </div>
    
    <div class="table-container">
        <form id="form1" name="form1" method="post" action="">
            <table class="data-table" id="userTable">
                <thead>
                    <tr>
                        <th width="50">S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Photo</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Place</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sel = "SELECT * FROM tbl_user u 
                            INNER JOIN tbl_place p ON u.place_id = p.place_id 
                            INNER JOIN tbl_district d ON p.district_id = d.district_id 
                            INNER JOIN tbl_state s ON d.state_id = s.state_id 
                            ORDER BY u.user_name ASC";
                    $row = $con->query($sel);
                    
                    if($row && $row->num_rows > 0) {
                        while($data = $row->fetch_assoc())
                        {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($data["user_name"]); ?></td>
                        <td><?php echo htmlspecialchars($data["user_email"]); ?></td>
                        <td><?php echo htmlspecialchars($data["user_contact"]); ?></td>
                        <td>
                            <img src="../Assets/Files/User/Photo/<?php echo $data["user_photo"]; ?>" 
                                 alt="<?php echo htmlspecialchars($data["user_name"]); ?>" 
                                 class="user-photo"
                                 onerror="this.src='../Assets/Files/User/Photo/default.jpg'">
                        </td>
                        <td><?php echo htmlspecialchars($data["state_name"]); ?></td>
                        <td><?php echo htmlspecialchars($data["district_name"]); ?></td>
                        <td><?php echo htmlspecialchars($data["place_name"]); ?></td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="8" class="no-data">No users found in the database.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<script>
function searchUsers() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toUpperCase();
    const table = document.getElementById('userTable');
    const tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        
        tr[i].style.display = found ? '' : 'none';
    }
}

function sortTable() {
    const select = document.getElementById('sortSelect');
    const sortBy = select.value;
    
    if (sortBy === '') return;
    
    alert('Sorting functionality would be implemented here. Sorting by: ' + sortBy);
    // Actual sorting implementation would require server-side processing or more complex JavaScript
}

function changeRowsPerPage() {
    const select = document.getElementById('rowsSelect');
    const rows = select.value;
    
    alert('Rows per page would be changed to: ' + rows);
    // Actual pagination implementation would require server-side processing
}

// Add event listener for Enter key in search
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchUsers();
    }
});
</script>
</body>
</html>
<?php
include('Footer.php');
?>