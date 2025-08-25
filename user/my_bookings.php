<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['un'])) {
    header("Location: login.php");
    exit();
}

// Get logged in user ID
$stmt = $con->prepare("SELECT uid FROM user WHERE email=? LIMIT 1");
$stmt->bind_param("s", $_SESSION['un']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$user_id = $user['uid'] ?? 0;

$stmt = $con->prepare("SELECT b.*, e.name AS event_name, e.event_date, e.location
                        FROM bookings b
                        JOIN events e ON b.event_id = e.event_id
                        WHERE b.user_id=? ORDER BY b.created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - Bharat Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .booking-card {
            background: white;
            position: relative;
            overflow: hidden;
            border: 2px solid #f3f4f6;
        }
        .booking-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #f89c2b, #ff7b00);
            z-index: 1;
        }
        .booking-content {
            position: relative;
            z-index: 2;
        }
        .status-paid { 
            background: linear-gradient(45deg, #10b981, #059669); 
            color: white;
        }
        .status-pending { 
            background: linear-gradient(45deg, #f89c2b, #ff7b00); 
            color: white;
        }
        .status-failed { 
            background: linear-gradient(45deg, #ef4444, #dc2626); 
            color: white;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(248, 156, 43, 0.1);
        }
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(248, 156, 43, 0.3);
            border-color: #f89c2b;
        }
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(248, 156, 43, 0.4); }
            to { box-shadow: 0 0 40px rgba(248, 156, 43, 0.6); }
        }
        .ticket-button {
            background: linear-gradient(135deg, #f89c2b, #ff7b00);
            transition: all 0.3s ease;
        }
        .ticket-button:hover {
            background: linear-gradient(135deg, #ff7b00, #e6890a);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(248, 156, 43, 0.3);
        }
        .icon-bg-orange {
            background: linear-gradient(135deg, #f89c2b, #ff7b00);
        }
        .text-orange-primary {
            color: #f89c2b;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100 min-h-screen">
<?php include("../includes/user_header.php"); ?>

<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-20 h-20 icon-bg-orange rounded-full mb-6 pulse-glow">
            <i class="fas fa-ticket-alt text-3xl text-white"></i>
        </div>
        <h1 class="text-5xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-4">
            My Event Tickets
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            View and manage all your booked event tickets
        </p>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <?php 
            $total_bookings = $result->num_rows;
            $result->data_seek(0); // Reset result pointer
            $total_spent = 0;
            $status_counts = ['Paid' => 0, 'Pending' => 0, 'Failed' => 0];
            
            while($row = $result->fetch_assoc()) {
                $total_spent += $row['total'];
                $status_counts[$row['payment_status']]++;
            }
            $result->data_seek(0); // Reset again for main loop
            ?>
            
            <div class="glass-effect rounded-2xl p-6 text-center hover-lift border-2 border-orange-100">
                <div class="text-3xl font-bold text-orange-primary mb-2"><?php echo $total_bookings; ?></div>
                <div class="text-gray-600 font-medium">Total Tickets</div>
            </div>
            
            <div class="glass-effect rounded-2xl p-6 text-center hover-lift border-2 border-orange-100">
                <div class="text-3xl font-bold text-orange-primary mb-2">₹<?php echo number_format($total_spent, 0); ?></div>
                <div class="text-gray-600 font-medium">Total Spent</div>
            </div>
            
            <div class="glass-effect rounded-2xl p-6 text-center hover-lift border-2 border-orange-100">
                <div class="text-3xl font-bold text-orange-primary mb-2"><?php echo $status_counts['Paid']; ?></div>
                <div class="text-gray-600 font-medium">Confirmed Tickets</div>
            </div>
        </div>

        <!-- Bookings Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php while($row = $result->fetch_assoc()):
                // Payment status styling
                $statusClass = match($row['payment_status']) {
                    'Paid' => 'status-paid',
                    'Pending' => 'status-pending',
                    'Failed' => 'status-failed',
                    default => 'bg-gray-500',
                };
                
                $statusIcon = match($row['payment_status']) {
                    'Paid' => 'fas fa-check-circle',
                    'Pending' => 'fas fa-clock',
                    'Failed' => 'fas fa-times-circle',
                    default => 'fas fa-question-circle',
                };
            ?>
                <div class="booking-card rounded-3xl p-8 hover-lift text-gray-800 relative overflow-hidden shadow-lg">
                    <div class="booking-content">
                        <!-- Status Badge -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="<?php echo $statusClass; ?> px-4 py-2 rounded-full flex items-center space-x-2 shadow-sm">
                                <i class="<?php echo $statusIcon; ?> text-sm"></i>
                                <span class="font-semibold text-sm"><?php echo $row['payment_status']; ?></span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500">Ticket ID</div>
                                <div class="font-mono font-bold text-orange-primary">#<?php echo str_pad($row['booking_id'], 4, '0', STR_PAD_LEFT); ?></div>
                            </div>
                        </div>

                        <!-- Event Info -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold mb-4 leading-tight text-gray-900">
                                <?php echo htmlspecialchars($row['event_name']); ?>
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4 p-3 bg-orange-50 rounded-xl">
                                    <div class="w-12 h-12 icon-bg-orange rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-calendar text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800"><?php echo date("F j, Y", strtotime($row['event_date'])); ?></div>
                                        <div class="text-sm text-gray-600"><?php echo date("l, g:i A", strtotime($row['event_date'])); ?></div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800"><?php echo htmlspecialchars($row['location']); ?></div>
                                        <div class="text-sm text-gray-600">Event Venue</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-xl">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-users text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800"><?php echo (int)$row['guests']; ?></div>
                                            <div class="text-xs text-gray-600">Guests</div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-xl">
                                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-credit-card text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800"><?php echo $row['payment_method']; ?></div>
                                            <div class="text-xs text-gray-600">Payment</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center p-4 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl border-2 border-orange-100">
                                    <div class="text-3xl font-bold text-orange-primary">₹<?php echo number_format($row['total'], 0); ?></div>
                                    <div class="text-sm text-gray-600 font-medium">Total Amount Paid</div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="view_booking.php?id=<?php echo $row['booking_id']; ?>" 
                           class="ticket-button block w-full text-white py-4 px-6 rounded-2xl font-semibold text-center transition-all duration-300">
                            <i class="fas fa-ticket-alt mr-3"></i>View Event Ticket
                        </a>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-orange-100 rounded-full opacity-30"></div>
                    <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-orange-50 rounded-full opacity-20"></div>
                </div>
            <?php endwhile; ?>
        </div>

    <?php else: ?>
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="glass-effect rounded-3xl p-12 max-w-md mx-auto border-2 border-orange-100">
                <div class="w-24 h-24 icon-bg-orange rounded-full mx-auto mb-8 flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-4xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No Event Tickets Yet</h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    You haven't booked any events yet. Start exploring our amazing events and get your first ticket!
                </p>
                <a href="all_events.php" 
                   class="ticket-button inline-flex items-center px-8 py-4 text-white font-semibold rounded-2xl transition-all duration-300 hover:scale-105 shadow-lg">
                    <i class="fas fa-search mr-3"></i>Browse Events
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>