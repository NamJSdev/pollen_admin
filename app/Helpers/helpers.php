<?php
if (!function_exists('getGreeting')) {
    function getGreeting()
    {
        // Thiết lập múi giờ Việt Nam
        $date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        $hour = (int) $date->format('H'); // Lấy giờ hiện tại

        if ($hour < 12) {
            return "Chào buổi sáng 🌅";
        } elseif ($hour < 18) {
            return "Chào buổi chiều 🌞";
        } else {
            return "Chào buổi tối 🌙";
        }
    }
}