# CodeIgniter CMS

A personal portfolio CMS built with **CodeIgniter 4**, **CodeIgniter Shield**, **Tailwind CSS**, and **MariaDB**.

## Features

### Public Frontend
- **Homepage** with latest projects and articles
- **About page** — personal bio and introduction
- **Portfolio projects** — paginated listing with category/tag filtering and detail pages
- **Articles/blog** — paginated listing with category/tag filtering and detail pages
- **Contact form** — sends email to the site owner
- **Comment system** — authenticated users can comment on articles and projects
- **Static pages** — FAQ, Privacy Policy, Terms of Service

### Admin Dashboard
- **Dashboard overview** — stats cards (users, articles, projects, skills, comments) + recent activity feed + quick actions
- **User management** — create, edit, delete users with status control
- **Role & permission management** — granular RBAC with matrix-based editor (5 groups, 20+ permissions)
- **Article management** — CRUD with categories, tags, featured image upload, status (published/draft/scheduled), SEO meta fields
- **Project management** — CRUD with categories, tags, URLs (live + GitHub), featured image, status, SEO meta
- **Category management** — inline CRUD for article/project taxonomies
- **Tag management** — inline CRUD with color coding
- **Comment moderation** — approve/reject/delete comments with admin notifications
- **Skills management** — CRUD with icons and sort order
- **Media library** — upload, browse (JSON endpoint), and delete images
- **Site settings** — site name, tagline, email, description, social links (GitHub, LinkedIn, Twitter, YouTube), theme mode, pagination, maintenance mode, registration toggle, date/time format, timezone, cache
- **Activity log** — paginated audit trail of all significant actions
- **Notifications** — real-time admin alerts (e.g., new comments) with mark-read / mark-all-read

### Authentication (CodeIgniter Shield)
- User registration and login
- Passwordless magic link login
- Remember-me tokens
- Account management

## Tech Stack

| Component | Technology |
|-----------|-----------|
| **Language** | PHP ^8.2 |
| **Framework** | CodeIgniter 4.7 |
| **Auth** | CodeIgniter Shield 1.3 |
| **Database** | MariaDB 10.11 |
| **Frontend** | Tailwind CSS 3.4, Font Awesome 6, Vanilla JS |
| **Testing** | PHPUnit 10.5 |
| **Dev Environment** | Docker Compose (PHP-FPM, Nginx, MariaDB, phpMyAdmin) |

## Permissions & Roles

| Role | Description |
|------|-------------|
| `superadmin` | Full system control |
| `admin` | Day-to-day administration |
| `developer` | Site development access |
| `user` | Default registered user |
| `beta` | Beta feature access |

Permissions cover: admin access, settings, user management, articles, projects, categories, tags, comments, skills, and beta features.

## Quick Start (Docker)

```bash
cp .env.example .env      # Configure database credentials
docker compose up -d      # Start all services
docker compose exec app php spark migrate --all   # Run migrations
docker compose exec app php spark db:seed DatabaseSeeder  # Seed data
```

Services:
- **App**: `http://localhost:8083`
- **phpMyAdmin**: `http://localhost:8090`

## Development

```bash
composer install
cp env .env
php spark serve
```

## License

MIT
