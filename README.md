# NEXORA TECHNOLOGY WEBSITE

A modern, responsive multi-page website for **NEXORA TECHNOLOGY**, showcasing the company's services, projects, career opportunities, blog, and contact information.

## About the Project

The NEXORA TECHNOLOGY website is designed to present a professional technology-company profile. Visitors can explore the company, learn about its services, view project case studies, read technology insights, and contact the team.

## Features

- Responsive multi-page website for desktop, tablet, and mobile screens.
- Home page with modern visual effects and animations.
- About and Services pages with company and service information.
- Projects portfolio with individual project detail pages.
- Project galleries and overview sections.
- Careers page with expandable job information and application links.
- Blog / insights page.
- Contact page with a contact form.

## Technologies Used

- HTML5
- CSS3
- JavaScript
- PHP (for server-side mail functionality, where configured)

## Project Structure

```text
IT_WEBSITE3/
├── index.html
├── about.html
├── services.html
├── service-details.html
├── technology-overview.html
├── projects.html
├── project-ecommerce.html
├── project-fittrack.html
├── project-homeease.html
├── project-supportai.html
├── project-analytics.html
├── careers.html
├── blog.html
├── contact.html
├── style.css
├── images/
├── send-email.php
├── send_mail.php
├── smtp-config.php
└── README.md
```

## How to Run the Project

### Option 1: View the static pages

1. Download or clone this repository.
2. Open the project folder.
3. Open `index.html` in a web browser.

> Note: PHP-based contact form functionality will not work by opening the HTML file directly. Use a local PHP server for the contact form.

### Option 2: Run with XAMPP

1. Install and open XAMPP.
2. Copy the `IT_WEBSITE3` folder into `C:\xampp\htdocs\`.
3. Start **Apache** from the XAMPP Control Panel.
4. Open `http://localhost/IT_WEBSITE3/` in your browser.
5. Configure the mail settings in `smtp-config.php` as required before testing the contact form.

## Project Pages

- `index.html` – Home
- `about.html` – About the company
- `services.html` – Services
- `projects.html` – Project portfolio
- `careers.html` – Career opportunities
- `blog.html` – Blog and insights
- `contact.html` – Contact form

## Notes

- Some project/gallery images are loaded from external image sources and require an internet connection.
- Configure and test the email settings on your PHP hosting environment before using the contact form in production.

## Author

**NEXORA TECHNOLOGY**
