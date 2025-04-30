# 💈 BarberShop Platform

A full-featured web platform that allows barbers to create and manage their digital presence, and clients to search, book, and review nearby barbershops.

## 🚀 Features

- 🔐 **User & Barber Authentication** - Secure login/register system with role-based access
- 📍 **Google Maps Integration** - Find nearby barbershops with real-time location data
- 📅 **Smart Appointment System** - Book, reschedule or cancel appointments with ease
- ⭐ **Review & Rating System** - Leave feedback and rate your barbershop experience
- 📊 **Advanced Admin Dashboard** - Complete statistics, verification processes and management tools
- 💬 **Real-time Chat** - Direct communication between clients and barbers
- 🔎 **Intelligent Search** - Filter by rating, price, availability, services, and more
- 🎨 **Responsive Design** - Optimized UI for all devices using modern frameworks
- 📱 **Progressive Web App** - Install on mobile devices for native-like experience

## 🛠️ Tech Stack

| Frontend | Backend | Database | DevOps | APIs |
|----------|---------|----------|--------|------|
| Blade Templates | Laravel 10.x | MySQL 8.0+ | Docker | Google Maps |
| TailwindCSS | PHP 8.2+ | Redis (Cache) | CI/CD Pipeline | Stripe (coming soon) |
| Alpine.js | Sanctum/Jetstream | ElasticSearch (optional) | GitHub Actions | Pusher/Socket.io |
| SCSS | RESTful API | | | Mailchimp |

## ⚙️ Installation

```bash
# Clone the repository
git clone https://github.com/aymane-06/BarberShop.git
cd BarberShop

# Install backend dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure database in .env then migrate and seed
php artisan migrate --seed

# Install frontend dependencies
npm install && npm run dev

# Start development server
php artisan serve
```

## 📷 Screenshots

<div align="center">
    <p><i>Screenshots coming soon</i></p>
   
</div>

## 🧠 Project Structure

```
BarberShop/
├── app/
│   ├── Models/             # Eloquent models
│   ├── Http/Controllers/   # Request handlers
│   ├── Services/           # Business logic
│   └── Policies/           # Authorization policies
├── database/
│   ├── migrations/         # Database structure
│   └── seeders/            # Sample data
├── routes/
│   ├── web.php             # Web routes
│   └── api.php             # API endpoints
└── resources/
        ├── views/              # Blade templates
        ├── js/                 # JavaScript assets
        └── css/                # Stylesheets
```

## 🔒 Security Features

- ✅ **Input validation & sanitization**
- 🛡️ **CSRF Protection**
- 👮 **Role-based authorization**
- 🔍 **SQL injection prevention**
- 📝 **Comprehensive audit logs**

## 🚀 Roadmap

- [ ] Push notification system
- [ ] Barber subscription tiers
- [ ] Payment processing integration
- [ ] Enhanced admin verification workflow
- [ ] Mobile application (React Native)
- [ ] Multi-language support
- [ ] Analytics dashboard for barbershop owners

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙋‍♂️ Author

**Aymane Himame**
- GitHub: [@aymane-06](https://github.com/aymane-06)
- LinkedIn: [Aymane Himame](www.linkedin.com/in/aymane-himame)

---

**⭐ Star this repository if you find it useful!**