<?php
class RewardModel {
    private $totalStamps = 10; // Total stempel yang diperlukan untuk reward

    public function getCurrentStamps() {
        // Mengambil jumlah stempel dari session (simulasi data pengguna)
        return isset($_SESSION['current_stamps']) ? $_SESSION['current_stamps'] : 0;
    }

    public function addStamp() {
        // Menambah stempel dan menyimpan ke session
        $_SESSION['current_stamps'] = $this->getCurrentStamps() + 1;
    }

    public function getStampsNeeded() {
        // Menghitung sisa stempel yang dibutuhkan
        return max(0, $this->totalStamps - $this->getCurrentStamps());
    }

    public function isRewardEarned() {
        // Mengecek apakah pengguna sudah mendapatkan reward
        return $this->getCurrentStamps() >= $this->totalStamps;
    }

    public function resetStamps() {
        // Reset jumlah stempel setelah klaim reward
        $_SESSION['current_stamps'] = 0;
    }

    public function addStampFromTransaction($transactionAmount) {
        // Logika: setiap kelipatan tertentu dari transaksi (misalnya 50k) dapat 1 stempel
        $stampsEarned = floor($transactionAmount / 50000); // 50k = 1 stempel
        $_SESSION['current_stamps'] = min($this->totalStamps, $this->getCurrentStamps() + $stampsEarned);
    }
    
}
