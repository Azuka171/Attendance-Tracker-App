<?php
if (isset($_SESSION['token'])) {
    # session variable present
    $sessionToken = $_SESSION['token'];
    // echo 'session tes'.$sessionToken;
    $sql = " SELECT * FROM sessions WHERE token = '$sessionToken'";
            $result = $conn->query($sql);
            $session_record_s = $result->fetch_assoc();
            // echo print_r($session_record);die;
            if ($session_record_s) {
                # token found
                $expires_at_s = $session_record_s['expires_at'];

                $currentTime = new DateTime();

                // Get the expires_at time as a DateTime object
                $expiresAt = new DateTime($expires_at_s);

                if ($currentTime > $expiresAt) {
                    unset($_SESSION['token']);
                    header('Location: ./login.php');
                    exit;
                } else{
                    #valid session
                    $new_expires_at = time() + (10 * 60);
                    $new_expires_at = date('Y-m-d H:i:s', $new_expires_at);
                    $userId_s = $session_record_s['userId'];
                    $upSql = "UPDATE sessions
                    SET expires_at = '$new_expires_at'
                    WHERE userId =$userId_s";
                    $conn->query($upSql);
                    echo 'valid session new expiration time'.$new_expires_at;
                }
                

            } else {
                # token not found
                unset($_SESSION['token']);
                header('Location: ./login.php');
                exit;
            }
} else {
    # session variable absentr
    header('Location: ./login.php');
    exit;
}

        
        
?>