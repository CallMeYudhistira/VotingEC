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

- **Framework**: Laravel 11.x
- **Frontend**: Blade, Bootstrap 5.3, Custom CSS
- **Database**: MySQL 8.0
- **Server**: FrankenPHP (via Laravel Octane)
- **Environment**: Docker & Docker Compose

## 🚀 Installation via Docker (Recommended)

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd VotingEC
   ```

2. **Setup Environment Variables**
   ```bash
   cp .env.example .env
   ```
   *Note: Default `.env.example` is pre-configured for the Docker setup.*

3. **Start the containers**
   ```bash
   docker compose up -d --build
   ```

4. **Install Dependencies & Generate Key**
   ```bash
   docker compose exec app composer install
   docker compose exec app php artisan key:generate
   ```

5. **Run Migrations & Seed Database**
   ```bash
   docker compose exec app php artisan migrate --seed
   ```

6. **Access the application**
   - Public Voting Page: `http://localhost:8002`
   - Admin Panel: `http://localhost:8002/admin`

## 🔐 Default Admin Credentials

After running migrations with the `--seed` flag, a default admin account is created:

- **Email**: `admin@votingec.com`
- **Password**: `password`

*(Please change the password immediately after logging in for the first time)*

## 📸 Screenshots

*(Add screenshots here before publishing to GitHub)*
- Landing Page
- Voting Interface
- Results Page
- Admin Dashboard

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
