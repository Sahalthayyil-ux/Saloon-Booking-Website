<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Complaints</title>
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
        max-width: 1200px;
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
    
    .filter-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
        gap: 10px;
    }
    
    .filter-select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: white;
        color: #000;
    }
    
    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }
    
    .complaint-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    .complaint-table th,
    .complaint-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }
    
    .complaint-table th {
        background-color: #000;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: sticky;
        top: 0;
    }
    
    .complaint-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .complaint-table tr:hover {
        background-color: #ffeeee;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-pending {
        background: #ffebee;
        color: #1616eb;
        border: 1px solid #1616eb;
    }
    
    .status-resolved {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #2e7d32;
    }
    
    .reply-btn {
        padding: 8px 16px;
        background: #1616eb;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .reply-btn:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(183, 28, 28, 0.3);
    }
    
    .reply-text {
        background: #f5f5f5;
        padding: 10px;
        border-radius: 4px;
        border-left: 3px solid #1616eb;
        color: #000;
        font-weight: 500;
    }
    
    .no-data {
        text-align: center;
        padding: 30px;
        color: #666;
        font-style: italic;
    }
    
    .content-cell {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
    }
    
    .content-cell:hover {
        white-space: normal;
        overflow: visible;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .stats-container {
            flex-direction: column;
        }
        
        .stat-card {
            margin: 0 0 10px 0;
        }
        
        .filter-container {
            flex-direction: column;
        }
        
        .complaint-table {
            font-size: 14px;
        }
        
        .complaint-table th,
        .complaint-table td {
            padding: 10px;
        }
        
        .complaint-table th:nth-child(3),
        .complaint-table td:nth-child(3) {
            display: none;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h1 class="page-title">Complaint Management</h1>
    
    <?php
    // Get complaint statistics
    $totalQuery = "SELECT COUNT(*) as total FROM tbl_complaint";
    $pendingQuery = "SELECT COUNT(*) as pending FROM tbl_complaint WHERE complaint_status = 0";
    $resolvedQuery = "SELECT COUNT(*) as resolved FROM tbl_complaint WHERE complaint_status = 1";
    
    $totalResult = $con->query($totalQuery);
    $pendingResult = $con->query($pendingQuery);
    $resolvedResult = $con->query($resolvedQuery);
    
    $total = $totalResult->fetch_assoc()['total'];
    $pending = $pendingResult->fetch_assoc()['pending'];
    $resolved = $resolvedResult->fetch_assoc()['resolved'];
    ?>
    
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number"><?php echo $total; ?></div>
            <div class="stat-label">Total Complaints</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $pending; ?></div>
            <div class="stat-label">Pending Complaints</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $resolved; ?></div>
            <div class="stat-label">Resolved Complaints</div>
        </div>
    </div>
    
    <div class="filter-container">
        <select class="filter-select" id="statusFilter" onchange="filterComplaints()">
            <option value="all">All Complaints</option>
            <option value="pending">Pending Only</option>
            <option value="resolved">Resolved Only</option>
        </select>
        
        <select class="filter-select" id="sortFilter" onchange="sortComplaints()">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
        </select>
    </div>
    
    <div class="table-container">
        <table class="complaint-table" id="complaintTable">
            <thead>
                <tr>
                    <th width="50">SI NO</th>
                    <th width="150">TITLE</th>
                    <th width="250">CONTENT</th>
                    <th width="100">DATE</th>
                    <th width="120">USER</th>
                    <th width="150">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sel = "SELECT * FROM tbl_complaint c INNER JOIN tbl_user u ON c.user_id = u.user_id ORDER BY c.complaint_date DESC";
                $row = $con->query($sel);
                
                if($row && $row->num_rows > 0) {
                    while($data = $row->fetch_assoc())
                    {
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($data["complaint_title"]); ?></td>
                    <td class="content-cell" title="<?php echo htmlspecialchars($data["complaint_content"]); ?>">
                        <?php echo htmlspecialchars($data["complaint_content"]); ?>
                    </td>
                    <td><?php echo date('M j, Y', strtotime($data["complaint_date"])); ?></td>
                    <td><?php echo htmlspecialchars($data["user_name"]); ?></td>
                    <td>
                        <?php
                        if($data['complaint_status'] == 1) {
                            echo '<span class="status-badge status-resolved">Resolved</span><br>';
                            echo '<div class="reply-text">' . htmlspecialchars($data['complaint_reply']) . '</div>';
                        } else {
                            echo '<span class="status-badge status-pending">Pending</span><br>';
                            echo '<a href="Reply.php?cid=' . $data['complaint_id'] . '" class="reply-btn">Reply</a>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="6" class="no-data">No complaints found.</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function filterComplaints() {
    const filter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#complaintTable tbody tr');
    
    rows.forEach(row => {
        const statusCell = row.querySelector('td:nth-child(6)');
        if (!statusCell) return;
        
        const isResolved = statusCell.querySelector('.status-resolved');
        
        if (filter === 'all') {
            row.style.display = '';
        } else if (filter === 'pending' && !isResolved) {
            row.style.display = '';
        } else if (filter === 'resolved' && isResolved) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function sortComplaints() {
    const sortBy = document.getElementById('sortFilter').value;
    alert('Sorting functionality would be implemented here. Sorting by: ' + sortBy);
    // Actual sorting would require server-side implementation or more complex JavaScript
}

// Add expandable content functionality
document.querySelectorAll('.content-cell').forEach(cell => {
    cell.addEventListener('click', function() {
        this.classList.toggle('expanded');
    });
});
</script>
</body>
</html>
<?php
include('Footer.php');
?>