<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant POS Lite - Complete Documentation</title>
  <link rel="icon" href="https://s.w.org/favicon.ico?2" sizes="32x32" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --secondary: #64748b;
      --accent: #f59e0b;
      --light: #f8fafc;
      --dark: #1e293b;
      --gray: #94a3b8;
      --gray-light: #e2e8f0;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --border-radius: 8px;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
      font-size: 16px;
      line-height: 1.6;
      color: var(--dark);
      background-color: #f1f5f9;
    }

    a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
    }

    a:hover {
      color: var(--primary-dark);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Header Styles */
    .header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      padding: 15px 0;
      box-shadow: var(--shadow);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 24px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo a {
      color: white;
    }

    .logo-icon {
      font-size: 28px;
    }

    .nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    .nav a {
      color: white;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 8px 12px;
      border-radius: var(--border-radius);
      transition: var(--transition);
    }

    .nav a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      text-decoration: none;
    }

    .nav i {
      font-size: 18px;
    }

    /* Mobile menu toggle */
    .menu-toggle {
      display: none;
      background: none;
      border: none;
      color: white;
      font-size: 24px;
      cursor: pointer;
    }

    /* Main Content Layout */
    .main-container {
      display: flex;
      gap: 30px;
      margin: 30px auto;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 280px;
      background-color: white;
      border-radius: var(--border-radius);
      padding: 25px;
      box-shadow: var(--shadow);
      position: sticky;
      top: 90px;
      height: fit-content;
      max-height: calc(100vh - 120px);
      overflow-y: auto;
    }

    .sidebar h3 {
      color: var(--primary);
      margin-bottom: 15px;
      font-size: 18px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--gray-light);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sidebar h3 i {
      font-size: 20px;
    }

    .sidebar ul {
      list-style: none;
      margin-bottom: 25px;
    }

    .sidebar li {
      margin-bottom: 8px;
    }

    .sidebar a {
      color: var(--secondary);
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 15px;
      border-radius: var(--border-radius);
      transition: var(--transition);
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: var(--primary);
      color: white;
      text-decoration: none;
    }

    .sidebar a i {
      width: 20px;
      text-align: center;
    }

    /* Content Area Styles */
    .content {
      flex: 1;
      background-color: white;
      border-radius: var(--border-radius);
      padding: 40px;
      box-shadow: var(--shadow);
    }

    .content h1 {
      color: var(--primary);
      font-size: 32px;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--gray-light);
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .content h1 i {
      color: var(--accent);
    }

    .content h2 {
      color: var(--primary);
      font-size: 26px;
      margin: 35px 0 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid var(--gray-light);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .content h2 i {
      font-size: 24px;
      color: var(--accent);
    }

    .content h3 {
      color: var(--dark);
      font-size: 20px;
      margin: 25px 0 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .content h3 i {
      font-size: 20px;
      color: var(--primary);
    }

    .content p {
      margin-bottom: 20px;
      color: var(--secondary);
    }

    .content ul,
    .content ol {
      margin-bottom: 20px;
      padding-left: 25px;
    }

    .content li {
      margin-bottom: 10px;
      color: var(--secondary);
    }

    /* Code Blocks */
    .code-block {
      background-color: #1e293b;
      border-radius: var(--border-radius);
      padding: 20px;
      margin: 20px 0;
      font-family: "Fira Code", Consolas, Monaco, "Andale Mono", monospace;
      font-size: 14px;
      line-height: 1.5;
      overflow-x: auto;
      color: #e2e8f0;
      box-shadow: var(--shadow);
    }

    .code-block code {
      color: #e2e8f0;
    }

    /* Note Boxes */
    .note {
      background-color: #dbeafe;
      border-left: 4px solid var(--primary);
      padding: 20px;
      margin: 20px 0;
      border-radius: 0 var(--border-radius) var(--border-radius) 0;
    }

    .note strong {
      color: var(--primary);
      display: block;
      margin-bottom: 5px;
    }

    .warning {
      background-color: #fef3c7;
      border-left: 4px solid var(--warning);
      padding: 20px;
    }

    .warning strong {
      color: var(--warning);
    }

    /* Tables */
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      box-shadow: var(--shadow);
      border-radius: var(--border-radius);
      overflow: hidden;
    }

    th {
      background-color: var(--primary);
      color: white;
      text-align: left;
      padding: 15px;
      font-weight: 600;
    }

    td {
      padding: 15px;
      border-bottom: 1px solid var(--gray-light);
    }

    tr:nth-child(even) {
      background-color: #f8fafc;
    }

    tr:hover {
      background-color: #f1f5f9;
    }

    /* Images */
    .content img {
      max-width: 100%;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow);
      margin: 20px 0;
      border: 1px solid var(--gray-light);
    }

    /* Footer Styles */
    .footer {
      background-color: var(--dark);
      color: white;
      padding: 40px 0;
      margin-top: 60px;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer-links {
      display: flex;
      gap: 20px;
    }

    .footer a {
      color: var(--gray);
    }

    .footer a:hover {
      color: white;
    }

    .social-links {
      display: flex;
      gap: 15px;
    }

    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      transition: var(--transition);
    }

    .social-links a:hover {
      background-color: var(--primary);
      transform: translateY(-3px);
    }

    /* Back to top button */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background-color: var(--primary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: var(--shadow-lg);
      cursor: pointer;
      transition: var(--transition);
      opacity: 0;
      visibility: hidden;
      z-index: 99;
    }

    .back-to-top.visible {
      opacity: 1;
      visibility: visible;
    }

    .back-to-top:hover {
      background-color: var(--primary-dark);
      transform: translateY(-3px);
    }

    /* Screenshot Styles */
    .screenshot-container {
      margin: 30px 0;
      text-align: center;
    }

    .doc-screenshot {
      max-width: 100%;
      border: 1px solid var(--gray-light);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-lg);
      transition: transform 0.3s ease;
    }

    .doc-screenshot:hover {
      transform: scale(1.02);
    }

    .screenshot-caption {
      text-align: center;
      font-style: italic;
      color: var(--secondary);
      margin-top: 10px;
      font-size: 14px;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .main-container {
        gap: 20px;
      }

      .sidebar {
        width: 240px;
      }
    }

    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        position: static;
        max-height: none;
      }

      .menu-toggle {
        display: block;
      }

      .nav {
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        background-color: var(--primary-dark);
        padding: 20px;
        box-shadow: var(--shadow);
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
      }

      .nav.active {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }

      .nav ul {
        flex-direction: column;
        gap: 10px;
      }

      .content {
        padding: 25px;
      }

      .footer-container {
        flex-direction: column;
        gap: 20px;
        text-align: center;
      }

      table {
        display: block;
        overflow-x: auto;
      }
    }

    @media (max-width: 480px) {
      .content {
        padding: 20px;
      }

      .content h1 {
        font-size: 28px;
      }

      .content h2 {
        font-size: 22px;
      }

      .sidebar {
        padding: 20px;
      }
    }

    /* Animation for content sections */
    .content-section {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .content-section.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container header-container">
      <div class="logo">
        <i class="fas fa-utensils logo-icon"></i>
        <a href="<?= base_url() ?>/documentation/wordpress-restaurant-pos-lite-plugin">Restaurant POS Lite</a>
      </div>
      <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
      </button>
      <nav class="nav" id="mainNav">
        <ul>
          <li>
            <a href="<?= base_url() ?>">
              <i class="fas fa-home"></i>
              Home
            </a>
          </li>
          <li>
            <a href="https://wordpress.org/plugins/obydullah-restaurant-pos-lite/">
              <i class="fas fa-download"></i>
              Download
            </a>
          </li>
          <li>
            <a href="https://wordpress.org/support/plugin/obydullah-restaurant-pos-lite/">
              <i class="fas fa-life-ring"></i>
              Support
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="container main-container">
    <aside class="sidebar">
      <h3><i class="fas fa-rocket"></i> Getting Started</h3>
      <ul>
        <li><a href="#introduction" class="active"><i class="fas fa-info-circle"></i> Introduction</a></li>
        <li><a href="#installation"><i class="fas fa-download"></i> Installation</a></li>
        <li><a href="#system-requirements"><i class="fas fa-server"></i> System Requirements</a></li>
        <li><a href="#quick-start"><i class="fas fa-bolt"></i> Quick Start Guide</a></li>
      </ul>

      <h3><i class="fas fa-star"></i> Features</h3>
      <ul>
        <li><a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#categories"><i class="fas fa-tags"></i> Categories</a></li>
        <li><a href="#products"><i class="fas fa-pizza-slice"></i> Products</a></li>
        <li><a href="#stocks"><i class="fas fa-boxes"></i> Stock Management</a></li>
        <li><a href="#stock-adjustments"><i class="fas fa-exchange-alt"></i> Stock Adjustments</a></li>
        <li><a href="#customers"><i class="fas fa-users"></i> Customers</a></li>
        <li><a href="#pos"><i class="fas fa-cash-register"></i> POS System</a></li>
        <li><a href="#sales"><i class="fas fa-chart-line"></i> Sales Management</a></li>
        <li><a href="#accounting"><i class="fas fa-calculator"></i> Accounting</a></li>
        <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
      </ul>

      <h3><i class="fas fa-question-circle"></i> Help & Support</h3>
      <ul>
        <li><a href="#faq"><i class="fas fa-question"></i> FAQ</a></li>
        <li><a href="#troubleshooting"><i class="fas fa-wrench"></i> Troubleshooting</a></li>
        <li><a href="#support"><i class="fas fa-headset"></i> Support</a></li>
      </ul>
    </aside>

    <main class="content">
      <h1><i class="fas fa-book"></i> Complete Documentation</h1>
      <p class="intro-text">Welcome to the official documentation for Restaurant POS Lite - your complete restaurant management solution for WordPress.</p>

      <section id="introduction" class="content-section">
        <h2><i class="fas fa-info-circle"></i> Introduction</h2>
        <p>
          <strong>Restaurant POS Lite</strong> is a comprehensive, feature-rich restaurant management system designed specifically for WordPress. It provides a complete solution for restaurants, cafes, food trucks, and any food service business to manage their operations efficiently from a single WordPress dashboard.
        </p>
        <p>
          The plugin offers a modern Point of Sale (POS) system, inventory management, customer relationship management (CRM), sales tracking, accounting, and detailed reporting - all integrated seamlessly into your WordPress admin area.
        </p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-1.png" alt="Dashboard Overview" class="doc-screenshot">
          <p class="screenshot-caption">Dashboard Overview – Main admin dashboard displaying key business metrics and summaries</p>
        </div>

        <h3><i class="fas fa-check-circle"></i> Key Benefits</h3>
        <ul>
          <li><strong>Complete Restaurant Management:</strong> Everything you need in one place</li>
          <li><strong>Easy to Use:</strong> Intuitive interface designed for busy restaurant environments</li>
          <li><strong>Real-time Operations:</strong> Live inventory updates and sales processing</li>
          <li><strong>Professional Reporting:</strong> Comprehensive sales and financial reports</li>
          <li><strong>Cost-effective:</strong> Free solution with premium features</li>
          <li><strong>WordPress Integration:</strong> Seamless integration with your existing WordPress site</li>
        </ul>
      </section>

      <section id="installation" class="content-section">
        <h2><i class="fas fa-download"></i> Installation</h2>
        <p>Installing Restaurant POS Lite is simple and straightforward. Follow these steps to get started:</p>

        <h3><i class="fas fa-plug"></i> Method 1: WordPress Admin (Recommended)</h3>
        <ol>
          <li>Log in to your WordPress admin dashboard</li>
          <li>Navigate to <strong>Plugins → Add New</strong></li>
          <li>Search for "Obydullah Restaurant POS Lite"</li>
          <li>Click <strong>Install Now</strong> next to the plugin</li>
          <li>After installation, click <strong>Activate</strong></li>
        </ol>

        <h3><i class="fas fa-file-upload"></i> Method 2: Manual Upload</h3>
        <ol>
          <li>Download the plugin ZIP file from WordPress.org</li>
          <li>Go to <strong>Plugins → Add New → Upload Plugin</strong></li>
          <li>Click <strong>Choose File</strong> and select the downloaded ZIP file</li>
          <li>Click <strong>Install Now</strong></li>
          <li>Click <strong>Activate Plugin</strong> after installation</li>
        </ol>

        <h3><i class="fas fa-database"></i> Database Setup</h3>
        <p>Upon activation, the plugin automatically creates the necessary database tables. You'll see a success message confirming the setup.</p>

        <div class="note">
          <strong>Note:</strong> The plugin creates the following database tables:
          <p></p>
          <ul>
            <li>orpl_categories (Product categories)</li>
            <li>orpl_products (Menu items)</li>
            <li>orpl_stocks (Inventory)</li>
            <li>orpl_customers (Customer database)</li>
            <li>orpl_sales (Sales records)</li>
            <li>orpl_sale_details (Sale line items)</li>
            <li>orpl_accounting (Financial records)</li>
          </ul>
        </div>
      </section>

      <section id="system-requirements" class="content-section">
        <h2><i class="fas fa-server"></i> System Requirements</h2>
        <p>To ensure optimal performance, your server should meet these minimum requirements:</p>

        <table>
          <tr>
            <th>Component</th>
            <th>Minimum Requirement</th>
            <th>Recommended</th>
          </tr>
          <tr>
            <td><strong>WordPress</strong></td>
            <td>5.0 or higher</td>
            <td>6.0 or higher</td>
          </tr>
          <tr>
            <td><strong>PHP Version</strong></td>
            <td>7.4 or higher</td>
            <td>8.0 or higher</td>
          </tr>
          <tr>
            <td><strong>MySQL</strong></td>
            <td>5.6 or higher</td>
            <td>5.7 or higher</td>
          </tr>
          <tr>
            <td><strong>Memory Limit</strong></td>
            <td>128MB</td>
            <td>256MB or higher</td>
          </tr>
          <tr>
            <td><strong>Browser</strong></td>
            <td>Chrome 60+, Firefox 55+</td>
            <td>Latest Chrome/Firefox</td>
          </tr>
        </table>

        <div class="warning">
          <strong>Important:</strong> The plugin uses modern PHP features. Using PHP versions below 7.4 may cause compatibility issues.
        </div>
      </section>

      <section id="quick-start" class="content-section">
        <h2><i class="fas fa-bolt"></i> Quick Start Guide</h2>
        <p>Follow this quick setup guide to get your restaurant POS running in minutes:</p>

        <h3><i class="fas fa-cog"></i> Step 1: Configure Settings</h3>
        <ol>
          <li>Go to <strong>OBY Restaurant POS → Settings</strong></li>
          <li>Enter your shop information (name, address, phone)</li>
          <li>Set your currency and tax/VAT rates</li>
          <li>Configure date format and other preferences</li>
          <li>Click <strong>Save Settings</strong></li>
        </ol>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-10.png" alt="Settings Panel" class="doc-screenshot">
          <p class="screenshot-caption">Settings Panel – Configure taxes, receipts, and system preferences</p>
        </div>

        <h3><i class="fas fa-tags"></i> Step 2: Create Categories</h3>
        <ol>
          <li>Go to <strong>OBY Restaurant POS → Categories</strong></li>
          <li>Add your menu categories (e.g., Appetizers, Main Course, Desserts)</li>
          <li>Set status to "Active" for visible categories</li>
        </ol>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-2.png" alt="Product Categories" class="doc-screenshot">
          <p class="screenshot-caption">Product Categories – Create and manage product categories for better menu organization</p>
        </div>

        <h3><i class="fas fa-pizza-slice"></i> Step 3: Add Products</h3>
        <ol>
          <li>Go to <strong>OBY Restaurant POS → Products</strong></li>
          <li>Add your menu items with names and categories</li>
          <li>Upload product images for better visual appeal</li>
        </ol>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-3.png" alt="Product Management" class="doc-screenshot">
          <p class="screenshot-caption">Product Management – Add, edit, and organize menu items with categories</p>
        </div>

        <h3><i class="fas fa-boxes"></i> Step 4: Manage Stock</h3>
        <ol>
          <li>Go to <strong>OBY Restaurant POS → Stocks</strong></li>
          <li>Add initial stock quantities for your products</li>
          <li>Set buy price and sale prices</li>
        </ol>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-4.png" alt="Stock Management" class="doc-screenshot">
          <p class="screenshot-caption">Stock Management – Monitor product stock levels and inventory availability</p>
        </div>

        <h3><i class="fas fa-cash-register"></i> Step 5: Start Taking Orders</h3>
        <p>You're now ready to use the POS system! Go to <strong>OBY Restaurant POS → POS</strong> and start processing orders.</p>
      </section>

      <section id="dashboard" class="content-section">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        <p>The dashboard provides a comprehensive overview of your restaurant's performance with real-time metrics and insights.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-1.png" alt="Dashboard Overview" class="doc-screenshot">
          <p class="screenshot-caption">Dashboard Overview – Main admin dashboard displaying key business metrics and summaries</p>
        </div>

        <h3><i class="fas fa-chart-line"></i> Key Metrics</h3>
        <table>
          <tr>
            <th>Metric</th>
            <th>Description</th>
            <th>Importance</th>
          </tr>
          <tr>
            <td><strong>Stock Value</strong></td>
            <td>Total value of current inventory</td>
            <td>Inventory investment tracking</td>
          </tr>
          <tr>
            <td><strong>Today's Sales</strong></td>
            <td>Number of completed orders today</td>
            <td>Daily performance indicator</td>
          </tr>
          <tr>
            <td><strong>Monthly Sales</strong></td>
            <td>Total orders this month</td>
            <td>Monthly performance tracking</td>
          </tr>
          <tr>
            <td><strong>Today's Income</strong></td>
            <td>Revenue generated today</td>
            <td>Daily cash flow</td>
          </tr>
          <tr>
            <td><strong>Monthly Income</strong></td>
            <td>Total revenue this month</td>
            <td>Monthly revenue tracking</td>
          </tr>
          <tr>
            <td><strong>Today's Expense</strong></td>
            <td>Expenses incurred today</td>
            <td>Daily cost monitoring</td>
          </tr>
          <tr>
            <td><strong>Monthly Expense</strong></td>
            <td>Total expenses this month</td>
            <td>Monthly cost analysis</td>
          </tr>
          <tr>
            <td><strong>Monthly Profit</strong></td>
            <td>Net profit (Income - Expense)</td>
            <td>Overall profitability</td>
          </tr>
        </table>

        <h3><i class="fas fa-chart-bar"></i> Data Interpretation</h3>
        <ul>
          <li><strong>Green metrics</strong> indicate positive financial indicators</li>
          <li><strong>Red metrics</strong> indicate areas needing attention</li>
          <li>All data updates in <strong>real-time</strong> as transactions occur</li>
          <li>Click any metric card for <strong>detailed breakdown</strong></li>
        </ul>
      </section>

      <section id="categories" class="content-section">
        <h2><i class="fas fa-tags"></i> Product Categories</h2>
        <p>Organize your menu items into logical categories for better management and customer navigation.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-2.png" alt="Product Categories" class="doc-screenshot">
          <p class="screenshot-caption">Product Categories – Create and manage product categories for better menu organization</p>
        </div>

        <h3><i class="fas fa-plus-circle"></i> Creating Categories</h3>
        <ol>
          <li>Navigate to <strong>OBY Restaurant POS → Categories</strong></li>
          <li>Enter a category name (e.g., "Beverages", "Main Course")</li>
          <li>Select status (Active/Inactive)</li>
          <li>Click <strong>Save Category</strong></li>
        </ol>

        <div class="note">
          <strong>Best Practice:</strong> Create broad categories first (Appetizers, Main Course, Desserts, Beverages) then add sub-categories if needed.
        </div>

        <h3><i class="fas fa-edit"></i> Managing Categories</h3>
        <table>
          <tr>
            <th>Action</th>
            <th>Description</th>
            <th>When to Use</th>
          </tr>
          <tr>
            <td><strong>Edit</strong></td>
            <td>Modify category name or status</td>
            <td>When menu changes or seasonal updates</td>
          </tr>
          <tr>
            <td><strong>Delete</strong></td>
            <td>Remove unused categories</td>
            <td>Cleaning up old categories</td>
          </tr>
          <tr>
            <td><strong>Status Change</strong></td>
            <td>Activate/Deactivate categories</td>
            <td>Temporarily hiding seasonal items</td>
          </tr>
        </table>

        <h3><i class="fas fa-lightbulb"></i> Tips for Effective Category Management</h3>
        <ul>
          <li>Keep category names <strong>short and descriptive</strong></li>
          <li>Use <strong>consistent naming conventions</strong></li>
          <li>Arrange categories in <strong>logical order</strong> (appetizers → main course → desserts)</li>
          <li>Set seasonal items to <strong>inactive</strong> when out of season</li>
          <li>Regularly <strong>review and update</strong> categories</li>
        </ul>
      </section>

      <section id="products" class="content-section">
        <h2><i class="fas fa-pizza-slice"></i> Product Management</h2>
        <p>Add and manage your restaurant's menu items with detailed information and images.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-3.png" alt="Product Management" class="doc-screenshot">
          <p class="screenshot-caption">Product Management – Add, edit, and organize menu items with categories</p>
        </div>

        <h3><i class="fas fa-plus-square"></i> Adding New Products</h3>
        <table>
          <tr>
            <th>Field</th>
            <th>Required</th>
            <th>Description</th>
            <th>Example</th>
          </tr>
          <tr>
            <td><strong>Product Name</strong></td>
            <td>Yes</td>
            <td>Name of the menu item</td>
            <td>"Margherita Pizza"</td>
          </tr>
          <tr>
            <td><strong>Category</strong></td>
            <td>Yes</td>
            <td>Product category</td>
            <td>"Main Course"</td>
          </tr>
          <tr>
            <td><strong>Product Image</strong></td>
            <td>No</td>
            <td>Visual representation</td>
            <td>Upload pizza image</td>
          </tr>
          <tr>
            <td><strong>Status</strong></td>
            <td>Yes</td>
            <td>Active/Inactive state</td>
            <td>"Active"</td>
          </tr>
        </table>

        <h3><i class="fas fa-images"></i> Product Images</h3>
        <p>Adding images to your products enhances the POS experience and helps staff identify items quickly.</p>
        <ul>
          <li><strong>Recommended size:</strong> 300x300 pixels</li>
          <li><strong>Supported formats:</strong> JPG, PNG, GIF</li>
          <li><strong>Maximum file size:</strong> 2MB</li>
          <li>Images are automatically <strong>optimized and resized</strong></li>
        </ul>

        <h3><i class="fas fa-search"></i> Product Search & Filtering</h3>
        <p>The products table includes powerful search and filtering capabilities:</p>
        <ul>
          <li><strong>Instant Search:</strong> Type to filter products by name</li>
          <li><strong>Pagination:</strong> Navigate large product lists easily</li>
          <li><strong>Status Filter:</strong> Show active/inactive products</li>
        </ul>

        <div class="note">
          <strong>Pro Tip:</strong> Use descriptive product names that are easily searchable. Include key ingredients or characteristics (e.g., "Spicy Chicken Burger" instead of just "Chicken Burger").
        </div>
      </section>

      <section id="stocks" class="content-section">
        <h2><i class="fas fa-boxes"></i> Stock Management</h2>
        <p>Track your inventory levels, costs, and availability with real-time stock management.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-4.png" alt="Stock Management" class="doc-screenshot">
          <p class="screenshot-caption">Stock Management – Monitor product stock levels and inventory availability</p>
        </div>

        <h3><i class="fas fa-box-open"></i> Adding Stock Entries</h3>
        <table>
          <tr>
            <th>Field</th>
            <th>Required</th>
            <th>Description</th>
            <th>Purpose</th>
          </tr>
          <tr>
            <td><strong>Product</strong></td>
            <td>Yes</td>
            <td>Select product from dropdown</td>
            <td>Link stock to menu item</td>
          </tr>
          <tr>
            <td><strong>Buy Price</strong></td>
            <td>Yes</td>
            <td>Cost price per unit</td>
            <td>Calculate profit margins</td>
          </tr>
          <tr>
            <td><strong>Sale Price</strong></td>
            <td>Yes</td>
            <td>Selling price per unit</td>
            <td>Customer pricing</td>
          </tr>
          <tr>
            <td><strong>Quantity</strong></td>
            <td>Yes</td>
            <td>Number of units in stock</td>
            <td>Inventory tracking</td>
          </tr>
          <tr>
            <td><strong>Status</strong></td>
            <td>Yes</td>
            <td>In Stock/Low Stock/Out of Stock</td>
            <td>Availability indicator</td>
          </tr>
        </table>

        <h3><i class="fas fa-chart-pie"></i> Stock Status Indicators</h3>
        <table>
          <tr>
            <th>Status</th>
            <th>Color</th>
            <th>Meaning</th>
            <th>Action Required</th>
          </tr>
          <tr>
            <td><strong>In Stock</strong></td>
            <td><span style="color: var(--success)">Green</span></td>
            <td>Adequate inventory available</td>
            <td>No action needed</td>
          </tr>
          <tr>
            <td><strong>Low Stock</strong></td>
            <td><span style="color: var(--warning)">Orange</span></td>
            <td>Inventory below threshold</td>
            <td>Consider reordering</td>
          </tr>
          <tr>
            <td><strong>Out of Stock</strong></td>
            <td><span style="color: var(--danger)">Red</span></td>
            <td>No inventory available</td>
            <td>Immediate reorder needed</td>
          </tr>
        </table>

        <h3><i class="fas fa-calculator"></i> Profit Calculation</h3>
        <p>The stock management system automatically calculates:</p>
        <ul>
          <li><strong>Unit Profit:</strong> Sale Price - Buy Price</li>
          <li><strong>Total Profit:</strong> Unit Profit × Quantity</li>
          <li><strong>Profit Margin:</strong> (Profit ÷ Sale Price) × 100</li>
          <li><strong>Total Stock Value:</strong> Buy Price × Quantity</li>
        </ul>

        <div class="note">
          <strong>Inventory Management:</strong> Regular stock updates ensure accurate menu availability and prevent selling items that are out of stock.
        </div>
      </section>

      <section id="stock-adjustments" class="content-section">
        <h2><i class="fas fa-exchange-alt"></i> Stock Adjustments</h2>
        <p>Manually adjust stock quantities for inventory corrections, waste tracking, or special circumstances.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-5.png" alt="Stock Adjustment" class="doc-screenshot">
          <p class="screenshot-caption">Stock Adjustment – Adjust stock quantities manually with reason tracking</p>
        </div>

        <h3><i class="fas fa-sliders-h"></i> Adjustment Types</h3>
        <table>
          <tr>
            <th>Type</th>
            <th>Icon</th>
            <th>Description</th>
            <th>Common Reasons</th>
          </tr>
          <tr>
            <td><strong>Increase</strong></td>
            <td><i class="fas fa-plus-circle text-success"></i></td>
            <td>Add stock to inventory</td>
            <td>New delivery, production, returns</td>
          </tr>
          <tr>
            <td><strong>Decrease</strong></td>
            <td><i class="fas fa-minus-circle text-danger"></i></td>
            <td>Remove stock from inventory</td>
            <td>Spoilage, waste, damage, staff meals</td>
          </tr>
        </table>

        <h3><i class="fas fa-clipboard-list"></i> Creating Adjustments</h3>
        <ol>
          <li>Select the <strong>product</strong> to adjust</li>
          <li>View <strong>current stock</strong> level</li>
          <li>Choose <strong>adjustment type</strong> (Increase/Decrease)</li>
          <li>Enter <strong>quantity</strong> to adjust</li>
          <li>Add <strong>notes</strong> explaining the adjustment</li>
          <li>Click <strong>Apply Adjustment</strong></li>
        </ol>

        <div class="warning">
          <strong>Important:</strong> Large stock decreases may indicate inventory issues. Always add detailed notes explaining the reason for significant adjustments.
        </div>

        <h3><i class="fas fa-history"></i> Adjustment History</h3>
        <p>All stock adjustments are logged with:</p>
        <ul>
          <li><strong>Date and time</strong> of adjustment</li>
          <li><strong>Adjustment details</strong> (type, quantity)</li>
          <li><strong>Notes</strong> explaining the reason</li>
          <li><strong>Stock levels</strong> before and after</li>
        </ul>
      </section>

      <section id="customers" class="content-section">
        <h2><i class="fas fa-users"></i> Customer Management</h2>
        <p>Build and maintain a customer database for better service and marketing in future.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-6.png" alt="Customer Management" class="doc-screenshot">
          <p class="screenshot-caption">Customer Management – Manage customer records, contact details</p>
        </div>

        <h3><i class="fas fa-user-plus"></i> Adding Customers</h3>
        <table>
          <tr>
            <th>Field</th>
            <th>Required</th>
            <th>Description</th>
            <th>Best Practices</th>
          </tr>
          <tr>
            <td><strong>Name</strong></td>
            <td>Yes</td>
            <td>Customer's full name</td>
            <td>Use proper capitalization</td>
          </tr>
          <tr>
            <td><strong>Email</strong></td>
            <td>No</td>
            <td>Email address</td>
            <td>Use for receipts and promotions</td>
          </tr>
          <tr>
            <td><strong>Phone</strong></td>
            <td>No</td>
            <td>Mobile number</td>
            <td>For order updates and alerts</td>
          </tr>
          <tr>
            <td><strong>Address</strong></td>
            <td>No</td>
            <td>Physical address</td>
            <td>For delivery orders</td>
          </tr>
          <tr>
            <td><strong>Notes</strong></td>
            <td>No</td>
            <td>Additional information</td>
            <td>Preferences, allergies, special requests</td>
          </tr>
        </table>

        <h3><i class="fas fa-search"></i> Customer Search & Filtering</h3>
        <p>Quickly find customers using:</p>
        <ul>
          <li><strong>Name Search:</strong> Partial name matching</li>
          <li><strong>Phone Search:</strong> Find by phone number</li>
          <li><strong>Email Search:</strong> Search by email address</li>
          <li><strong>Status Filter:</strong> Active/Inactive customers</li>
        </ul>

        <div class="note">
          <strong>Customer Relationship Tip:</strong> Use the notes field to remember customer preferences (e.g., "Prefers booth seating", "Allergic to nuts", "Regular takeaway customer").
        </div>
      </section>

      <section id="pos" class="content-section">
        <h2><i class="fas fa-cash-register"></i> POS System</h2>
        <p>The Point of Sale interface is the heart of your restaurant operations, designed for speed and efficiency.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-7.png" alt="POS Interface" class="doc-screenshot">
          <p class="screenshot-caption">POS Interface – Point of Sale screen with product grid, cart, and order panel</p>
        </div>

        <h3><i class="fas fa-th-large"></i> Product Grid Interface</h3>
        <ul>
          <li><strong>Category Tabs:</strong> Quick navigation between product categories</li>
          <li><strong>Product Cards:</strong> Visual representation with images</li>
          <li><strong>Stock Indicators:</strong> Real-time availability status</li>
        </ul>

        <h3><i class="fas fa-shopping-cart"></i> Order Processing Workflow</h3>
        <ol>
          <li><strong>Select Customer:</strong> Choose existing or walk-in</li>
          <li><strong>Choose Sale Type:</strong> Dine-in, Takeaway, or Pickup</li>
          <li><strong>Add Products:</strong> Click items from the grid</li>
          <li><strong>Adjust Quantities:</strong> Use +/- buttons in cart</li>
          <li><strong>Apply Modifiers:</strong> Discounts, special instructions</li>
          <li><strong>Review Totals:</strong> Check calculations</li>
          <li><strong>Complete Sale:</strong> Finalize</li>
        </ol>

        <h3><i class="fas fa-utensils"></i> Sale Types</h3>
        <table>
          <tr>
            <th>Type</th>
            <th>Icon</th>
            <th>Required Fields</th>
            <th>Use Case</th>
          </tr>
          <tr>
            <td><strong>Dine-in</strong></td>
            <td><i class="fas fa-chair"></i></td>
            <td>Table Number</td>
            <td>Customers eating at the restaurant</td>
          </tr>
          <tr>
            <td><strong>Takeaway</strong></td>
            <td><i class="fas fa-truck"></i></td>
            <td>Customer Name, Phone</td>
            <td>Delivery or pickup later</td>
          </tr>
          <tr>
            <td><strong>Pickup</strong></td>
            <td><i class="fas fa-box"></i></td>
            <td>Customer Name</td>
            <td>Customer collects order</td>
          </tr>
        </table>

        <h3><i class="fas fa-calculator"></i> Real-time Calculations</h3>
        <p>The POS automatically calculates:</p>
        <ul>
          <li><strong>Subtotal:</strong> Sum of all items</li>
          <li><strong>Discounts:</strong> Manual or percentage discounts</li>
          <li><strong>Tax/VAT:</strong> Based on configured rates</li>
          <li><strong>Delivery Charges:</strong> For takeaway orders</li>
          <li><strong>Grand Total:</strong> Final payable amount</li>
        </ul>

        <div class="note">
          <strong>Speed Tips:</strong> Use keyboard shortcuts for faster order processing. Memorize product positions for quick selection during busy periods.
        </div>

        <h3><i class="fas fa-save"></i> Order Management Options</h3>
        <table>
          <tr>
            <th>Button</th>
            <th>Action</th>
            <th>When to Use</th>
            <th>Result</th>
          </tr>
          <tr>
            <td><strong>Clear</strong></td>
            <td>Reset current order</td>
            <td>Wrong order started</td>
            <td>Empty cart, reset form</td>
          </tr>
          <tr>
            <td><strong>Save</strong></td>
            <td>Save order for later</td>
            <td>Pending payment or modification</td>
            <td>Order saved in system</td>
          </tr>
          <tr>
            <td><strong>Complete</strong></td>
            <td>Finalize and process</td>
            <td>Order ready for payment</td>
            <td>Stock updated, receipt generated</td>
          </tr>
        </table>
      </section>

      <section id="sales" class="content-section">
        <h2><i class="fas fa-chart-line"></i> Sales Management</h2>
        <p>Track, analyze, and manage all your restaurant's sales transactions with comprehensive reporting tools.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-8.png" alt="Sales History" class="doc-screenshot">
          <p class="screenshot-caption">Sales History – View, search, and filter completed sales with receipt printing options</p>
        </div>

        <h3><i class="fas fa-filter"></i> Advanced Filtering Options</h3>
        <table>
          <tr>
            <th>Filter Type</th>
            <th>Options</th>
            <th>Purpose</th>
            <th>Business Use</th>
          </tr>
          <tr>
            <td><strong>Date Range</strong></td>
            <td>Today, Yesterday, Custom Range</td>
            <td>Time-based analysis</td>
            <td>Daily/Weekly/Monthly reports</td>
          </tr>
          <tr>
            <td><strong>Sale Type</strong></td>
            <td>Dine-in, Takeaway, Pickup</td>
            <td>Service type analysis</td>
            <td>Optimize service channels</td>
          </tr>
          <tr>
            <td><strong>Status</strong></td>
            <td>Completed, Saved, Canceled</td>
            <td>Order status tracking</td>
            <td>Monitor order flow</td>
          </tr>
        </table>

        <h3><i class="fas fa-receipt"></i> Sales Data Columns</h3>
        <p>Each sales record includes detailed information:</p>
        <ul>
          <li><strong>Invoice ID:</strong> Unique transaction identifier</li>
          <li><strong>Date & Time:</strong> When the sale occurred</li>
          <li><strong>Customer:</strong> Who made the purchase</li>
          <li><strong>Items:</strong> Products purchased</li>
          <li><strong>Quantities:</strong> Number of each item</li>
          <li><strong>Subtotal:</strong> Before tax/discount</li>
          <li><strong>Discount:</strong> Any discounts applied</li>
          <li><strong>Tax/VAT:</strong> Tax amounts</li>
          <li><strong>Total:</strong> Final amount paid</li>
          <li><strong>Status:</strong> Current order status</li>
        </ul>

        <h3><i class="fas fa-print"></i> Receipt & Invoice Printing</h3>
        <p>Generate professional receipts and invoices with multiple options:</p>

        <table>
          <tr>
            <th>Print Type</th>
            <th>Content</th>
            <th>Use Case</th>
            <th>Customization</th>
          </tr>
          <tr>
            <td><strong>Customer Receipt</strong></td>
            <td>Basic transaction details</td>
            <td>Customer copy</td>
            <td>Shop logo, thank you message</td>
          </tr>
          <tr>
            <td><strong>Kitchen Ticket</strong></td>
            <td>Order items only</td>
            <td>Kitchen preparation</td>
            <td>Cooking instructions, table number</td>
          </tr>
          <tr>
            <td><strong>Detailed Invoice</strong></td>
            <td>Full transaction breakdown</td>
            <td>Business records</td>
            <td>Tax details, terms & conditions</td>
          </tr>
          <tr>
            <td><strong>Summary Report</strong></td>
            <td>Multiple orders summary</td>
            <td>End of day reporting</td>
            <td>Custom date ranges, filters</td>
          </tr>
        </table>

        <div class="note">
          <strong>Reporting Tip:</strong> Use the date range filter to generate custom period reports. Compare different time periods to identify growth trends and seasonal patterns.
        </div>
      </section>

      <section id="accounting" class="content-section">
        <h2><i class="fas fa-calculator"></i> Accounting Module</h2>
        <p>Track your restaurant's financial health with comprehensive income, expense, and profitability tracking.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-9.png" alt="Accounting Module" class="doc-screenshot">
          <p class="screenshot-caption">Accounting Module – Track income, expenses, and overall financial summaries</p>
        </div>

        <h3><i class="fas fa-chart-pie"></i> Financial Dashboard</h3>
        <table>
          <tr>
            <th>Metric</th>
            <th>Calculation</th>
            <th>Importance</th>
            <th>Healthy Range</th>
          </tr>
          <tr>
            <td><strong>Total Income</strong></td>
            <td>Sum of all revenue</td>
            <td>Revenue tracking</td>
            <td>Consistent growth</td>
          </tr>
          <tr>
            <td><strong>Total Expenses</strong></td>
            <td>Sum of all costs</td>
            <td>Cost control</td>
            <td>Below 70% of income</td>
          </tr>
          <tr>
            <td><strong>Net Profit</strong></td>
            <td>Income - Expenses</td>
            <td>Profitability</td>
            <td>Positive and growing</td>
          </tr>
          <tr>
            <td><strong>Profit Margin</strong></td>
            <td>(Profit ÷ Income) × 100</td>
            <td>Efficiency measure</td>
            <td>15-30% for restaurants</td>
          </tr>
          <tr>
            <td><strong>Average Daily Revenue</strong></td>
            <td>Income ÷ Days</td>
            <td>Performance tracking</td>
            <td>Industry benchmark</td>
          </tr>
        </table>

        <h3><i class="fas fa-receipt"></i> Expense Categories</h3>
        <p>Organize expenses for better financial management:</p>
        <table>
          <tr>
            <th>Category</th>
            <th>Examples</th>
            <th>Typical % of Revenue</th>
            <th>Management Tips</th>
          </tr>
          <tr>
            <td><strong>Food Cost</strong></td>
            <td>Ingredients, supplies</td>
            <td>25-35%</td>
            <td>Monitor waste, negotiate prices</td>
          </tr>
          <tr>
            <td><strong>Labor Cost</strong></td>
            <td>Salaries, wages</td>
            <td>25-35%</td>
            <td>Optimize scheduling</td>
          </tr>
          <tr>
            <td><strong>Rent & Utilities</strong></td>
            <td>Rent, electricity, water</td>
            <td>5-10%</td>
            <td>Fixed cost, monitor usage</td>
          </tr>
          <tr>
            <td><strong>Marketing</strong></td>
            <td>Advertising, promotions</td>
            <td>3-5%</td>
            <td>Track ROI on campaigns</td>
          </tr>
          <tr>
            <td><strong>Maintenance</strong></td>
            <td>Repairs, equipment</td>
            <td>2-4%</td>
            <td>Preventive maintenance</td>
          </tr>
          <tr>
            <td><strong>Miscellaneous</strong></td>
            <td>Office supplies, fees</td>
            <td>1-2%</td>
            <td>Review regularly</td>
          </tr>
        </table>

        <h3><i class="fas fa-calendar-alt"></i> Financial Reporting</h3>
        <p>Generate various financial reports:</p>
        <ul>
          <li><strong>Daily Sales Report:</strong> End-of-day summary</li>
          <li><strong>Weekly Performance:</strong> Week-over-week analysis</li>
          <li><strong>Monthly P&L:</strong> Profit and Loss statement</li>
          <li><strong>Quarterly Review:</strong> Seasonal performance</li>
          <li><strong>Annual Summary:</strong> Year-end financials</li>
        </ul>

        <div class="note">
          <strong>Financial Health Tip:</strong> Regularly review your food cost percentage. Industry standard is 28-35% of food sales. Higher percentages may indicate waste, theft, or pricing issues.
        </div>

        <h3><i class="fas fa-chart-bar"></i> Key Performance Indicators (KPIs)</h3>
        <p>Monitor these essential restaurant metrics:</p>
        <ul>
          <li><strong>Food Cost Percentage:</strong> (Food Cost ÷ Food Sales) × 100</li>
          <li><strong>Labor Cost Percentage:</strong> (Labor Cost ÷ Total Sales) × 100</li>
          <li><strong>Prime Cost:</strong> Food Cost + Labor Cost</li>
          <li><strong>Table Turnover Rate:</strong> Guests per table per day</li>
          <li><strong>Average Check Size:</strong> Total Sales ÷ Number of Guests</li>
          <li><strong>Sales per Square Foot:</strong> Total Sales ÷ Restaurant Area</li>
        </ul>
      </section>

      <section id="settings" class="content-section">
        <h2><i class="fas fa-cog"></i> Settings & Configuration</h2>
        <p>Customize the POS system to match your restaurant's specific needs and preferences.</p>

        <div class="screenshot-container">
          <img src="<?= base_url() ?>assets/doc/restaurant-pos-lite/screenshot/screenshot-10.png" alt="Settings Panel" class="doc-screenshot">
          <p class="screenshot-caption">Settings Panel – Configure taxes, receipts, and system preferences</p>
        </div>

        <h3><i class="fas fa-store"></i> Shop Information</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Required</th>
            <th>Description</th>
            <th>Appears On</th>
          </tr>
          <tr>
            <td><strong>Restaurant Name</strong></td>
            <td>Yes</td>
            <td>Your business name</td>
            <td>All receipts and reports</td>
          </tr>
          <tr>
            <td><strong>Address</strong></td>
            <td>Yes</td>
            <td>Business location</td>
            <td>Receipts, invoices</td>
          </tr>
          <tr>
            <td><strong>Phone Number</strong></td>
            <td>Yes</td>
            <td>Contact number</td>
            <td>Receipts, customer communications</td>
          </tr>
        </table>

        <h3><i class="fas fa-money-bill"></i> Currency & Pricing</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Options</th>
            <th>Default</th>
            <th>Impact</th>
          </tr>
          <tr>
            <td><strong>Currency Symbol</strong></td>
            <td>$ € £ ₹ ¥ etc.</td>
            <td>$</td>
            <td>All price displays</td>
          </tr>
          <tr>
            <td><strong>Currency Position</strong></td>
            <td>Left, Right, Left with space, Right with space</td>
            <td>Left</td>
            <td>Price formatting</td>
          </tr>
        </table>

        <h3><i class="fas fa-percentage"></i> Tax & VAT Configuration</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Description</th>
            <th>Default</th>
            <th>Calculation</th>
          </tr>
          <tr>
            <td><strong>VAT Rate (%)</strong></td>
            <td>Percentage VAT rate</td>
            <td>0%</td>
            <td>VAT = Subtotal × Rate</td>
          </tr>
          <tr>
            <td><strong>Tax Rate (%)</strong></td>
            <td>Percentage tax rate</td>
            <td>0%</td>
            <td>Tax = Subtotal × Rate</td>
          </tr>
        </table>

        <h3><i class="fas fa-receipt"></i> Receipt & Printing</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Options</th>
            <th>Default</th>
            <th>Purpose</th>
          </tr>
          <tr>
            <td><strong>Receipt Header</strong></td>
            <td>Custom text/HTML</td>
            <td>Shop name</td>
            <td>Top of receipt</td>
          </tr>
          <tr>
            <td><strong>Receipt Footer</strong></td>
            <td>Custom text/HTML</td>
            <td>Thank you message</td>
            <td>Bottom of receipt</td>
          </tr>
          <tr>
            <td><strong>Print Automatically</strong></td>
            <td>Yes/No</td>
            <td>No</td>
            <td>Auto-print after sale</td>
          </tr>
        </table>

        <h3><i class="fas fa-calendar"></i> Date & Time</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Options</th>
            <th>Default</th>
            <th>Format Example</th>
          </tr>
          <tr>
            <td><strong>Date Format</strong></td>
            <td>YYYY-MM-DD, DD-MM-YYYY, MM/DD/YYYY</td>
            <td>YYYY-MM-DD</td>
            <td>2024-12-15</td>
          </tr>
        </table>

        <h3><i class="fas fa-bell"></i> Notifications & Alerts</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Description</th>
            <th>Default</th>
            <th>Alert Method</th>
          </tr>
          <tr>
            <td><strong>Low Stock Alert</strong></td>
            <td>Notify when stock is low</td>
            <td>Enabled</td>
            <td>Dashboard warning</td>
          </tr>
          <tr>
            <td><strong>Alert Threshold</strong></td>
            <td>Quantity for low stock alert</td>
            <td>10</td>
            <td>Customizable</td>
          </tr>
          <tr>
            <td><strong>Daily Sales Report</strong></td>
            <td>Email end-of-day report</td>
            <td>Disabled</td>
            <td>Email notification</td>
          </tr>
          <tr>
            <td><strong>New Order Sound</strong></td>
            <td>Play sound for new orders</td>
            <td>Enabled</td>
            <td>Browser notification</td>
          </tr>
          <tr>
            <td><strong>Print Sound</strong></td>
            <td>Play sound when printing</td>
            <td>Enabled</td>
            <td>Browser notification</td>
          </tr>
        </table>

        <div class="note">
          <strong>Configuration Tip:</strong> Test your receipt settings with a few test prints before going live. Ensure your printer is properly configured and the receipt layout matches your requirements.
        </div>

        <h3><i class="fas fa-shield-alt"></i> Security Settings</h3>
        <table>
          <tr>
            <th>Setting</th>
            <th>Description</th>
            <th>Default</th>
            <th>Security Level</th>
          </tr>
          <tr>
            <td><strong>User Roles</strong></td>
            <td>Who can access POS</td>
            <td>Administrator only</td>
            <td>High</td>
          </tr>
          <tr>
            <td><strong>Password Protection</strong></td>
            <td>Require password for voids</td>
            <td>Enabled</td>
            <td>Medium</td>
          </tr>
          <tr>
            <td><strong>Session Timeout</strong></td>
            <td>Auto-logout after inactivity</td>
            <td>30 minutes</td>
            <td>Medium</td>
          </tr>
          <tr>
            <td><strong>IP Restriction</strong></td>
            <td>Allow specific IPs only</td>
            <td>Disabled</td>
            <td>High</td>
          </tr>
          <tr>
            <td><strong>Audit Log</strong></td>
            <td>Log all transactions</td>
            <td>Enabled</td>
            <td>Medium</td>
          </tr>
        </table>
      </section>

      <section id="faq" class="content-section">
        <h2><i class="fas fa-question-circle"></i> Frequently Asked Questions</h2>

        <h3><i class="fas fa-download"></i> Installation & Setup</h3>
        <div class="note">
          <strong>Q: Is the plugin free?</strong><br>
          A: Yes, Obydullah Restaurant POS Lite is completely free with all core features included.
        </div>

        <div class="note">
          <strong>Q: What are the system requirements?</strong><br>
          A: WordPress 5.0+, PHP 7.4+, MySQL 5.6+. See the System Requirements section for details.
        </div>

        <div class="note">
          <strong>Q: Can I use it with any WordPress theme?</strong><br>
          A: Yes, the plugin works with any WordPress theme. It uses its own admin interface.
        </div>

        <h3><i class="fas fa-cash-register"></i> POS Operations</h3>

        <div class="note">
          <strong>Q: How do I handle discounts?</strong><br>
          A: In the POS interface, enter discount amount or percentage in the discount field before completing the sale.
        </div>

        <h3><i class="fas fa-boxes"></i> Inventory Management</h3>
        <div class="note">
          <strong>Q: Does the system prevent overselling?</strong><br>
          A: Yes, the POS automatically checks stock levels and prevents sales when items are out of stock.
        </div>

        <div class="note">
          <strong>Q: How do I track waste/spoilage?</strong><br>
          A: Use the Stock Adjustments feature to decrease stock quantities and add notes explaining the reason.
        </div>

        <h3><i class="fas fa-chart-line"></i> Reporting & Analytics</h3>

        <div class="note">
          <strong>Q: Can I compare sales between different periods?</strong><br>
          A: Yes, use the date range filters in the Sales section to compare performance across different time periods.
        </div>

        <h3><i class="fas fa-print"></i> Receipt & Printing</h3>
        <div class="note">
          <strong>Q: What printers are supported?</strong><br>
          A: Any standard thermal receipt printer (Epson, Star, etc.) that works with Windows printers.
        </div>
      </section>

      <section id="troubleshooting" class="content-section">
        <h2><i class="fas fa-wrench"></i> Troubleshooting</h2>

        <h3><i class="fas fa-exclamation-triangle"></i> Common Issues</h3>
        <table>
          <tr>
            <th>Issue</th>
            <th>Possible Cause</th>
            <th>Solution</th>
          </tr>
          <tr>
            <td><strong>Plugin not installing</strong></td>
            <td>PHP version too old</td>
            <td>Upgrade to PHP 7.4 or higher</td>
          </tr>
          <tr>
            <td><strong>Database errors</strong></td>
            <td>MySQL version incompatible</td>
            <td>Upgrade to MySQL 5.6 or higher</td>
          </tr>
          <tr>
            <td><strong>POS not loading</strong></td>
            <td>JavaScript conflicts</td>
            <td>Deactivate other plugins to test</td>
          </tr>
          <tr>
            <td><strong>Slow performance</strong></td>
            <td>Large database or low memory</td>
            <td>Increase PHP memory limit to 256MB</td>
          </tr>
          <tr>
            <td><strong>Printing issues</strong></td>
            <td>Printer not configured</td>
            <td>Check printer settings and drivers</td>
          </tr>
          <tr>
            <td><strong>Stock not updating</strong></td>
            <td>Cache issues</td>
            <td>Clear browser and server cache</td>
          </tr>
        </table>

        <h3><i class="fas fa-tools"></i> Maintenance Tips</h3>
        <ul>
          <li><strong>Regular Backups:</strong> Always backup your database before updates</li>
          <li><strong>Clear Cache:</strong> Clear browser cache if experiencing display issues</li>
          <li><strong>Update Regularly:</strong> Keep WordPress and plugins updated</li>
          <li><strong>Monitor Logs:</strong> Check error logs for troubleshooting clues</li>
          <li><strong>Test Updates:</strong> Test updates on staging site first</li>
          <li><strong>Clean Database:</strong> Archive old sales data periodically</li>
        </ul>

        <div class="warning">
          <strong>Important:</strong> Always create a full backup of your WordPress site and database before making major changes or updates.
        </div>
      </section>

      <section id="support" class="content-section">
        <h2><i class="fas fa-headset"></i> Support & Resources</h2>

        <h3><i class="fas fa-life-ring"></i> Getting Help</h3>
        <table>
          <tr>
            <th>Resource</th>
            <th>Description</th>
            <th>Best For</th>
            <th>Response Time</th>
          </tr>
          <tr>
            <td><strong>WordPress.org Forums</strong></td>
            <td>Official support forum</td>
            <td>General questions, installation help</td>
            <td>1-3 days</td>
          </tr>
          <tr>
            <td><strong>GitHub Issues</strong></td>
            <td>Bug reports and feature requests</td>
            <td>Technical issues, suggestions</td>
            <td>2-5 days</td>
          </tr>
          <tr>
            <td><strong>Documentation</strong></td>
            <td>This documentation site</td>
            <td>Self-help, tutorials, guides</td>
            <td>Instant</td>
          </tr>
        </table>

        <h3><i class="fas fa-book"></i> Additional Resources</h3>
        <ul>
          <li><strong>Video Tutorials:</strong> Step-by-step video guides</li>
          <li><strong>User Guide:</strong> Comprehensive PDF manual</li>
          <li><strong>API Documentation:</strong> For developers and integrators</li>
          <li><strong>Community Forum:</strong> User discussions and tips</li>
          <li><strong>Blog:</strong> Tips, updates, and announcements</li>
        </ul>

        <h3><i class="fas fa-hands-helping"></i> Community Support</h3>
        <p>Join our community for additional support:</p>
        <ul>
          <li><strong>Share Tips:</strong> Learn from other restaurant owners</li>
          <li><strong>Feature Requests:</strong> Suggest new features</li>
          <li><strong>Bug Reports:</strong> Help improve the plugin</li>
          <li><strong>Translations:</strong> Help translate the plugin</li>
        </ul>

        <div class="note">
          <strong>Support Tip:</strong> When requesting support, always include:
          <p></p>
          <ul>
            <li>WordPress version</li>
            <li>PHP version</li>
            <li>Plugin version</li>
            <li>Error messages (if any)</li>
            <li>Steps to reproduce the issue</li>
          </ul>
        </div>
      </section>
    </main>
  </div>

  <footer class="footer">
    <div class="container footer-container">
      <div class="copyright">
        &copy; 2024 - <?= date('Y') ?> Obydullah. All rights reserved.<br>
        <small>Obydullah Restaurant POS Lite v1.0.1</small>
      </div>
      <div class="footer-links">
        <a href="https://obydullah.com/privacy-policy">Privacy Policy</a>
        <a href="https://obydullah.com/terms">Terms of Service</a>
        <a href="https://obydullah.com/contact">Contact Support</a>
      </div>
      <div class="social-links">
        <a href="https://github.com/shaik-obydullah/restaurant-pos-lite" title="GitHub"><i class="fab fa-github"></i></a>
        <a href="https://wordpress.org/plugins/obydullah-restaurant-pos-lite/" title="WordPress"><i class="fab fa-wordpress"></i></a>
        <a href="https://obydullah.com" title="Website"><i class="fas fa-globe"></i></a>
      </div>
    </div>
  </footer>

  <div class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
  </div>

  <script>
    // Mobile menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    menuToggle.addEventListener('click', () => {
      mainNav.classList.toggle('active');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!menuToggle.contains(e.target) && !mainNav.contains(e.target)) {
        mainNav.classList.remove('active');
      }
    });

    // Back to top button
    const backToTop = document.getElementById('backToTop');

    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        backToTop.classList.add('visible');
      } else {
        backToTop.classList.remove('visible');
      }
    });

    backToTop.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Active sidebar link highlighting
    const sections = document.querySelectorAll('.content-section');
    const sidebarLinks = document.querySelectorAll('.sidebar a');

    // Intersection Observer for section visibility
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');

          // Update active sidebar link
          const id = entry.target.getAttribute('id');
          sidebarLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${id}`) {
              link.classList.add('active');
            }
          });
        }
      });
    }, observerOptions);

    sections.forEach(section => {
      observer.observe(section);
    });

    // Smooth scrolling for sidebar links
    sidebarLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();

        const targetId = link.getAttribute('href');
        const targetSection = document.querySelector(targetId);

        if (targetSection) {
          // Close mobile menu if open
          mainNav.classList.remove('active');

          window.scrollTo({
            top: targetSection.offsetTop - 100,
            behavior: 'smooth'
          });
        }
      });
    });

    // Add print button functionality for code blocks
    document.querySelectorAll('.code-block').forEach(block => {
      const printBtn = document.createElement('button');
      printBtn.innerHTML = '<i class="fas fa-print"></i> Copy';
      printBtn.style.cssText = `
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--primary);
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
      `;
      printBtn.addEventListener('click', () => {
        const code = block.querySelector('code').innerText;
        navigator.clipboard.writeText(code).then(() => {
          printBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
          setTimeout(() => {
            printBtn.innerHTML = '<i class="fas fa-print"></i> Copy';
          }, 2000);
        });
      });
      block.style.position = 'relative';
      block.appendChild(printBtn);
    });
  </script>
</body>
</html>