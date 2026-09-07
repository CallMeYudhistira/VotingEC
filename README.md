# English Club Voting System 🗳️

A modern, dynamic voting system built for the English Club president election. Built with **Laravel 11**, it features a beautiful glassmorphism design for the public voting interface and a fully-featured admin panel for managing candidates and voting sessions.

## 🌟 Features

### Public Voting Interface (English)
- **Dynamic Status Landing Page**: Adapts intelligently based on whether voting has not started, is currently active, or has ended.
- **Glassmorphism Design**: Modern, premium aesthetic with Baloo 2 font and teal gradients.
- **Candidate Cards**: Displays candidates dynamically from the database.
- **Vote Confirmation**: Prevents accidental clicks.
- **Real-time Results**: Beautiful winner announcements with percentage bars (only visible when voting is closed).

### Admin Panel (Indonesian)
- **Secure Authentication**: Protected admin routes.
- **Dashboard Overview**: Total candidates, votes, and real-time live rankings.
- **Voting Status Control**: Instantly switch between "Belum Dimulai" (Not Started), "Mulai Voting" (Active), and "Tutup Voting" (Closed).
- **Candidate Management**: Full CRUD operations with image upload support for candidate photos.
- **Reset Votes**: Option to clear all votes for a fresh election.

## 🛠️ Technology Stack

- **Framework**: Laravel 11.0
- **Frontend**: Blade, Bootstrap 5.3, Custom CSS
- **Database**: MySQL 8.0

## 🚀 Installation Guide

1. **Clone the repository**
   ```bash
   git clone https://github.com/CallMeYudhistira/VotingEC.git
   cd VotingEC
   ```

2. **Setup Environment Variables**
   ```bash
   cp .env.example .env
   ```

3. **Install Dependencies & Generate Key**
   ```bash
   composer install
   php artisan key:generate
   ```

5. **Run Migrations & Seed Database**
   ```bash
   php artisan migrate --seed
   ```

6. **Access the application**
   ```bash
   php artisan serve --port=8003
   ```
   
   - Public Voting Page: `http://localhost:8003`
   - Admin Panel: `http://localhost:8003/admin`

## 🔐 Default Admin Credentials

After running migrations with the `--seed` flag, a default admin account is created:

- **Email**: `admin@votingec.com`
- **Password**: `password`

*(Please change the password immediately after logging in for the first time)*
