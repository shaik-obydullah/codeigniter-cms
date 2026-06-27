<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lime CSS Framework Documentation</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/doc/lime-css-framework/lime.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/doc/lime-css-framework/docs.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍃</text></svg>" />
    <link rel="icon" type="image/png" sizes="32x32" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABPUlEQVRYw+2Wy0oDQRRFb7uCz4Uo+B3CRnDhu1DxAa4UdSt+htBFdxEUFD+ECN0JSV8fZ97p1KS3E3Ip3AOFpFB1b52ZzAQaTf2JA/wkU8PpS3LMTbKq1ADJZ8BvGg2TXC1UQfIWsF6J7RWV4FUgUw7JnYggeJYPpH03yRsu9cAfKfI04Cp3L10Q8ELyBkmdQPB+13L8V9t3w7JBYC9XBQFVcy6fLLVHMqWq9S1nB9U7eOVI7is/YFkru+S6qjwg+eFkXrZc5QGSb3C2rSTnXewDkaBc3AfWXW8EymHZ2thM2aBpO24BdwU3MpZF/XwX2EdzNpHslB4guQ8gNp5Ivi+9GAPIAeC2vydUc+9t1XrW9ST5LKDq5YI3obfBV7toj/wCdiKqOCF5zKKf+D+NYZ2MvXlAAAAASUVORK5CYII=" />
    <link rel="icon" type="image/png" sizes="16x16" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAU0lEQVQ4y2P4//8/AyUYieh6BgYGBgaGDeQYwIjGXkC2ITC1CzAMIBqj1JCrDuYCRgq8j8UGhr2UGoAYDWS7gBEXH4ZxGUAtDACDSDaAagYwMAAAPBwS7128lqgAAAAASUVORK5CYII=" />
    <link rel="apple-touch-icon" sizes="180x180" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAC0CAYAAAA9zQYyAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAXElEQVR4nO3QMQEAAAgDoJviD7QNBrIOBwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgNHtAZAwASQMxlsAAAAASUVORK5CYII=" />
    <meta name="theme-color" content="#32cd32" />
  </head>

  <body>
    <!-- Header -->
    <header class="header">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
            <a href="#" class="logo">
              <div class="logo-icon">
                <i class="fas fa-leaf"></i>
              </div>
              <div class="logo-text">
                <span class="logo-title">Lime CSS</span>
                <span class="logo-subtitle">Lightweight Framework</span>
              </div>
            </a>
          </div>

          <div class="header-right d-flex align-items-center">
            <div class="version-badge mr-4">
              <span class="badge badge-success">v1.0.0</span>
            </div>

            <div class="header-actions">
              <a href="#download" class="btn btn-sm btn-outline-primary mr-2 d-none d-md-inline-block">
                <i class="fas fa-download mr-1"></i>
                Download
              </a>
              <a href="https://github.com" target="_blank" class="btn btn-sm btn-dark d-none d-md-inline-block">
                <i class="fab fa-github mr-1"></i>
                GitHub
              </a>
            </div>
          </div>

          <!-- Menu toggle moved here to left side -->
          <button class="menu-toggle mr-3" id="menuToggle">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>
    </header>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar" id="sidebar">
      <ul class="sidebar-nav">
        <li class="nav-section">Getting Started</li>
        <li><a href="#introduction" class="active">Introduction</a></li>
        <li><a href="#installation">Installation</a></li>
        <li><a href="#quick-start">Quick Start</a></li>

        <li class="nav-section">Layout</li>
        <li><a href="#container">Container</a></li>
        <li><a href="#grid">Grid System</a></li>

        <li class="nav-section">Components</li>
        <li><a href="#buttons">Buttons</a></li>
        <li><a href="#forms">Forms</a></li>
        <li><a href="#tables">Tables</a></li>
        <li><a href="#alerts">Alerts</a></li>
        <li><a href="#navbar">Navbar</a></li>

        <li class="nav-section">Utilities</li>
        <li><a href="#colors">Colors</a></li>
        <li><a href="#spacing">Spacing</a></li>
        <li><a href="#display">Display</a></li>
        <li><a href="#text">Text</a></li>
        <li><a href="#borders">Borders</a></li>
        <li><a href="#rounded">Rounded</a></li>
        <li><a href="#shadows">Shadows</a></li>

        <li class="nav-section">Extras</li>
        <li><a href="#responsive">Responsive</a></li>
        <li><a href="#customization">Customization</a></li>
        <li><a href="#changelog">Changelog</a></li>
      </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Introduction -->
      <section id="introduction" class="section">
        <h2>Introduction</h2>
        <p>Lime CSS is a lightweight, responsive CSS framework built with modern web development in mind. With its fresh lime-themed design and comprehensive set of components, it provides everything you need to build beautiful, responsive web interfaces quickly.</p>

        <div class="callout">
          <p>
            <strong>Why Lime CSS?</strong>
            Unlike other frameworks, Lime CSS focuses on simplicity and performance while providing all essential components for modern web development.
          </p>
        </div>

        <h3>Features</h3>
        <div class="row mt-4">
          <div class="col-md-4 mb-4">
            <div class="component-demo">
              <h4 class="demo-title">
                <i class="fas fa-mobile-alt text-primary mr-2"></i>
                Responsive
              </h4>
              <p>Built with a mobile-first approach, works seamlessly on all devices.</p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="component-demo">
              <h4 class="demo-title">
                <i class="fas fa-bolt text-primary mr-2"></i>
                Lightweight
              </h4>
              <p>Only 25KB minified, with zero JavaScript dependencies.</p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="component-demo">
              <h4 class="demo-title">
                <i class="fas fa-palette text-primary mr-2"></i>
                Customizable
              </h4>
              <p>Easy to customize with CSS variables and SASS/SCSS support.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Installation -->
      <section id="installation" class="section">
        <h2>Installation</h2>
        <p>There are several ways to include Lime CSS in your project:</p>

        <h3>Method 1: CDN (Recommended for testing)</h3>
        <div class="code-block">
          <pre><code class="language-html">&lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lime-css/dist/lime.min.css"&gt;</code></pre>
        </div>

        <h3>Method 2: Download</h3>
        <p>Download the compiled CSS files:</p>
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="component-demo text-center">
              <h5 class="demo-title">lime.css</h5>
              <p>Development version (unminified)</p>
              <button class="btn btn-primary btn-sm mt-2">Download</button>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="component-demo text-center">
              <h5 class="demo-title">lime.min.css</h5>
              <p>Production version (minified)</p>
              <button class="btn btn-primary btn-sm mt-2">Download</button>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="component-demo text-center">
              <h5 class="demo-title">lime-variables.css</h5>
              <p>CSS variables version</p>
              <button class="btn btn-primary btn-sm mt-2">Download</button>
            </div>
          </div>
        </div>

        <h3>Method 3: NPM</h3>
        <div class="code-block">
          <pre><code class="language-bash">npm install lime-css</code></pre>
        </div>
      </section>

      <!-- Quick Start -->
      <section id="quick-start" class="section">
        <h2>Quick Start</h2>
        <p>Copy this starter template to get started quickly:</p>

        <div class="code-block">
          <pre><code class="language-html">&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;My Lime CSS Project&lt;/title&gt;
    &lt;link rel="stylesheet" href="dist/lime.css"&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;div class="container"&gt;
        &lt;h1 class="text-primary"&gt;Hello, World!&lt;/h1&gt;
        &lt;p&gt;This is a starter template using Lime CSS.&lt;/p&gt;
        &lt;button class="btn btn-primary"&gt;Primary Button&lt;/button&gt;
    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
      </section>

      <!-- Container -->
      <section id="container" class="section">
        <h2>Container</h2>
        <p>Containers are the most basic layout element in Lime CSS and are required when using the default grid system. Choose from a responsive, fixed-width container (using pixel breakpoints) or a fluid-width container (full width of its parent).</p>

        <div class="component-demo">
          <div class="demo-title">Fixed Container</div>
          <div class="container border p-4 bg-light">
            <p>This is a fixed-width container. It will resize at breakpoints:</p>
            <ul>
              <li>≥576px: max-width 540px</li>
              <li>≥768px: max-width 720px</li>
              <li>≥992px: max-width 960px</li>
              <li>≥1200px: max-width 1140px</li>
            </ul>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;div class="container"&gt;
  &lt;!-- Your content here --&gt;
&lt;/div&gt;

&lt;!-- Fluid container --&gt;
&lt;div class="container-fluid"&gt;
  &lt;!-- Your content here --&gt;
&lt;/div&gt;</code></pre>
        </div>
      </section>

      <!-- Grid System -->
      <section id="grid" class="section">
        <h2>Grid System</h2>
        <p>Lime CSS includes a responsive 12-column grid system built with flexbox. It's fully responsive and works on all screen sizes.</p>

        <div class="component-demo grid-demo">
          <div class="demo-title">Grid Example</div>
          <div class="row">
            <div class="col-12">col-12 (full width)</div>
          </div>
          <div class="row">
            <div class="col-6">col-6 (half width)</div>
            <div class="col-6">col-6 (half width)</div>
          </div>
          <div class="row">
            <div class="col-4">col-4 (one third)</div>
            <div class="col-4">col-4 (one third)</div>
            <div class="col-4">col-4 (one third)</div>
          </div>
          <div class="row">
            <div class="col-3">col-3</div>
            <div class="col-3">col-3</div>
            <div class="col-3">col-3</div>
            <div class="col-3">col-3</div>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;div class="container"&gt;
  &lt;div class="row"&gt;
    &lt;div class="col-md-6 col-lg-4"&gt;
      &lt;!-- Content for medium (50%) and large (33%) screens --&gt;
    &lt;/div&gt;
    &lt;div class="col-md-6 col-lg-8"&gt;
      &lt;!-- Content for medium (50%) and large (66%) screens --&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h3>Responsive Breakpoints</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Breakpoint</th>
                <th>Class Prefix</th>
                <th>Dimensions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Extra small</td>
                <td><code>.col-</code></td>
                <td>&lt;576px</td>
              </tr>
              <tr>
                <td>Small</td>
                <td><code>.col-sm-</code></td>
                <td>≥576px</td>
              </tr>
              <tr>
                <td>Medium</td>
                <td><code>.col-md-</code></td>
                <td>≥768px</td>
              </tr>
              <tr>
                <td>Large</td>
                <td><code>.col-lg-</code></td>
                <td>≥992px</td>
              </tr>
              <tr>
                <td>Extra large</td>
                <td><code>.col-xl-</code></td>
                <td>≥1200px</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Buttons -->
      <section id="buttons" class="section">
        <h2>Buttons</h2>
        <p>Use Lime CSS's custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and variants.</p>

        <div class="component-demo button-demo">
          <div class="demo-title">Button Variants</div>
          <button class="btn btn-primary">Primary</button>
          <button class="btn btn-secondary">Secondary</button>
          <button class="btn btn-success">Success</button>
          <button class="btn btn-danger">Danger</button>
          <button class="btn btn-warning">Warning</button>
          <button class="btn btn-info">Info</button>
          <button class="btn btn-light">Light</button>
          <button class="btn btn-dark">Dark</button>
          <button class="btn btn-lime">
            Lime
            <span class="badge">Custom</span>
          </button>
        </div>

        <div class="component-demo button-demo">
          <div class="demo-title">Button Sizes</div>
          <button class="btn btn-primary btn-lg">Large</button>
          <button class="btn btn-primary">Default</button>
          <button class="btn btn-primary btn-sm">Small</button>
        </div>

        <div class="component-demo">
          <div class="demo-title">Block Buttons</div>
          <button class="btn btn-primary btn-block mb-2">Block Button</button>
          <button class="btn btn-secondary btn-block">Another Block Button</button>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Button variants --&gt;
&lt;button class="btn btn-primary"&gt;Primary&lt;/button&gt;
&lt;button class="btn btn-secondary"&gt;Secondary&lt;/button&gt;

&lt;!-- Button sizes --&gt;
&lt;button class="btn btn-primary btn-lg"&gt;Large&lt;/button&gt;
&lt;button class="btn btn-primary btn-sm"&gt;Small&lt;/button&gt;

&lt;!-- Block button --&gt;
&lt;button class="btn btn-primary btn-block"&gt;Block Button&lt;/button&gt;</code></pre>
        </div>
      </section>

      <!-- Forms -->
      <section id="forms" class="section">
        <h2>Forms</h2>
        <p>Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms.</p>

        <div class="component-demo">
          <div class="demo-title">Basic Form</div>
          <form>
            <div class="form-group">
              <label for="exampleEmail">Email address</label>
              <input type="email" class="form-control" id="exampleEmail" placeholder="Enter email" />
              <small class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
              <label for="examplePassword">Password</label>
              <input type="password" class="form-control" id="examplePassword" placeholder="Password" />
            </div>

            <div class="form-group">
              <label for="exampleSelect">Select</label>
              <select class="form-control" id="exampleSelect">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleTextarea">Textarea</label>
              <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Enter your message"></textarea>
            </div>

            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="exampleCheck" />
                <label class="form-check-label" for="exampleCheck">Remember me</label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;form&gt;
  &lt;div class="form-group"&gt;
    &lt;label for="email"&gt;Email address&lt;/label&gt;
    &lt;input type="email" class="form-control" id="email" placeholder="Enter email"&gt;
  &lt;/div&gt;
  
  &lt;div class="form-group"&gt;
    &lt;label for="password"&gt;Password&lt;/label&gt;
    &lt;input type="password" class="form-control" id="password" placeholder="Password"&gt;
  &lt;/div&gt;
  
  &lt;button type="submit" class="btn btn-primary"&gt;Submit&lt;/button&gt;
&lt;/form&gt;</code></pre>
        </div>
      </section>

      <!-- Tables -->
      <section id="tables" class="section">
        <h2>Tables</h2>
        <p>Documentation and examples for opt-in styling of tables with Lime CSS.</p>

        <div class="component-demo table-demo">
          <div class="demo-title">Basic Table</div>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John</td>
                <td>Doe</td>
                <td>@johndoe</td>
                <td><span class="text-success">Active</span></td>
              </tr>
              <tr>
                <td>2</td>
                <td>Jane</td>
                <td>Smith</td>
                <td>@janesmith</td>
                <td><span class="text-warning">Pending</span></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Bob</td>
                <td>Johnson</td>
                <td>@bobjohnson</td>
                <td><span class="text-danger">Inactive</span></td>
              </tr>
              <tr>
                <td>4</td>
                <td>Alice</td>
                <td>Williams</td>
                <td>@alicew</td>
                <td><span class="text-success">Active</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="component-demo table-demo">
          <div class="demo-title">Striped Table</div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Laptop</td>
                <td>$999.99</td>
                <td>25</td>
                <td>Electronics</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Wireless Mouse</td>
                <td>$29.99</td>
                <td>150</td>
                <td>Electronics</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Mechanical Keyboard</td>
                <td>$89.99</td>
                <td>45</td>
                <td>Electronics</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Monitor</td>
                <td>$249.99</td>
                <td>30</td>
                <td>Electronics</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="component-demo table-demo">
          <div class="demo-title">Bordered Table</div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Project</th>
                <th>Progress</th>
                <th>Deadline</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Website Redesign</td>
                <td>80%</td>
                <td>2023-12-15</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Mobile App</td>
                <td>45%</td>
                <td>2024-01-30</td>
              </tr>
              <tr>
                <td>3</td>
                <td>API Integration</td>
                <td>100%</td>
                <td>2023-11-20</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="component-demo table-demo">
          <div class="demo-title">Hover Table</div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Order</th>
                <th>Amount</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John Smith</td>
                <td>#ORD-001</td>
                <td>$199.99</td>
                <td>2023-11-01</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Jane Doe</td>
                <td>#ORD-002</td>
                <td>$299.99</td>
                <td>2023-11-02</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Bob Johnson</td>
                <td>#ORD-003</td>
                <td>$149.99</td>
                <td>2023-11-03</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="component-demo table-demo">
          <div class="demo-title">Colored Tables</div>
          <p class="text-muted mb-3">Table with contextual classes:</p>

          <table class="table mb-4">
            <thead>
              <tr class="table-primary">
                <th>#</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Fix login issue</td>
                <td>High</td>
                <td class="table-success">Completed</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Update documentation</td>
                <td>Medium</td>
                <td class="table-warning">In Progress</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Server maintenance</td>
                <td>Low</td>
                <td class="table-danger">Delayed</td>
              </tr>
            </tbody>
          </table>

          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Department</th>
                <th>Budget</th>
                <th>Spent</th>
                <th>Remaining</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Marketing</td>
                <td>$50,000</td>
                <td>$32,500</td>
                <td class="text-success">$17,500</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Development</td>
                <td>$100,000</td>
                <td>$85,000</td>
                <td class="text-warning">$15,000</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Sales</td>
                <td>$75,000</td>
                <td>$90,000</td>
                <td class="text-danger">-$15,000</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Basic table --&gt;
&lt;table class="table"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th&gt;#&lt;/th&gt;
      &lt;th&gt;Name&lt;/th&gt;
      &lt;th&gt;Username&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;td&gt;1&lt;/td&gt;
      &lt;td&gt;John Doe&lt;/td&gt;
      &lt;td&gt;@johndoe&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;

&lt;!-- Striped table --&gt;
&lt;table class="table table-striped"&gt;
  &lt;!-- table content --&gt;
&lt;/table&gt;

&lt;!-- Bordered table --&gt;
&lt;table class="table table-bordered"&gt;
  &lt;!-- table content --&gt;
&lt;/table&gt;

&lt;!-- Hoverable table --&gt;
&lt;table class="table table-hover"&gt;
  &lt;!-- table content --&gt;
&lt;/table&gt;

&lt;!-- Table with contextual classes --&gt;
&lt;table class="table"&gt;
  &lt;thead&gt;
    &lt;tr class="table-primary"&gt;
      &lt;th&gt;#&lt;/th&gt;
      &lt;th&gt;Task&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr class="table-success"&gt;
      &lt;td&gt;1&lt;/td&gt;
      &lt;td&gt;Completed task&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
        </div>

        <h3>Table Classes</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><code>.table</code></td>
                <td>Base class for all tables. Sets basic styling, width, margins, and border-collapse.</td>
              </tr>
              <tr>
                <td><code>.table-striped</code></td>
                <td>Adds zebra-striping to table rows (alternating background colors).</td>
              </tr>
              <tr>
                <td><code>.table-bordered</code></td>
                <td>Adds borders on all sides of the table and cells.</td>
              </tr>
              <tr>
                <td><code>.table-hover</code></td>
                <td>Enables hover effect on table rows (background color change on hover).</td>
              </tr>
              <tr>
                <td><code>.table-primary</code></td>
                <td>Contextual class for primary colored table rows or cells.</td>
              </tr>
              <tr>
                <td><code>.table-success</code></td>
                <td>Contextual class for success colored table rows or cells.</td>
              </tr>
              <tr>
                <td><code>.table-danger</code></td>
                <td>Contextual class for danger colored table rows or cells.</td>
              </tr>
              <tr>
                <td><code>.table-warning</code></td>
                <td>Contextual class for warning colored table rows or cells.</td>
              </tr>
              <tr>
                <td><code>.table-info</code></td>
                <td>Contextual class for info colored table rows or cells.</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="callout info">
          <p>
            <strong>Note:</strong>
            Lime CSS tables use consistent padding (0.75rem) for both header and data cells. The header cells have
            <code>vertical-align: bottom</code>
            and a bottom border, while data cells have
            <code>vertical-align: top</code>
            .
          </p>
        </div>
      </section>

      <!-- Alerts -->
      <section id="alerts" class="section">
        <h2>Alerts</h2>
        <p>Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages.</p>

        <div class="component-demo alert-demo">
          <div class="demo-title">Alert Variants</div>
          <div class="alert alert-primary">This is a primary alert—check it out!</div>
          <div class="alert alert-success">This is a success alert—check it out!</div>
          <div class="alert alert-danger">This is a danger alert—check it out!</div>
          <div class="alert alert-warning">This is a warning alert—check it out!</div>
          <div class="alert alert-info">This is an info alert—check it out!</div>
          <div class="alert alert-light">This is a light alert—check it out!</div>
          <div class="alert alert-dark">This is a dark alert—check it out!</div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;div class="alert alert-primary"&gt;
  This is a primary alert!
&lt;/div&gt;

&lt;div class="alert alert-success"&gt;
  This is a success alert!
&lt;/div&gt;

&lt;div class="alert alert-danger"&gt;
  This is a danger alert!
&lt;/div&gt;</code></pre>
        </div>
      </section>

      <!-- Navbar -->
      <section id="navbar" class="section">
        <h2>Navbar</h2>
        <p>A basic navigation header with support for branding and navigation links.</p>

        <div class="callout info">
          <p>
            <strong>Note:</strong>
            Lime CSS provides a basic navbar structure. For horizontal layouts, you'll need to add your own CSS or use flex utilities.
          </p>
        </div>

        <div class="component-demo">
          <div class="demo-title">Basic Navbar (Default vertical layout)</div>

          <nav class="navbar mb-4">
            <a class="navbar-brand" href="#">Navbar Brand</a>
            <ul class="navbar-nav">
              <li>
                <a class="nav-link active" href="#">Home</a>
              </li>
              <li>
                <a class="nav-link" href="#">Features</a>
              </li>
              <li>
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li>
                <a class="nav-link" href="#">About</a>
              </li>
            </ul>
          </nav>
        </div>

        <div class="component-demo">
          <div class="demo-title">Navbar with Background Color</div>

          <nav class="navbar bg-primary text-white mb-4">
            <a class="navbar-brand text-white" href="#">Brand</a>
            <ul class="navbar-nav">
              <li>
                <a class="nav-link text-white" href="#">Link 1</a>
              </li>
              <li>
                <a class="nav-link text-white" href="#">Link 2</a>
              </li>
            </ul>
          </nav>

          <nav class="navbar bg-dark text-white">
            <a class="navbar-brand text-white" href="#">Brand</a>
            <ul class="navbar-nav">
              <li>
                <a class="nav-link text-white" href="#">Link 1</a>
              </li>
              <li>
                <a class="nav-link text-white" href="#">Link 2</a>
              </li>
            </ul>
          </nav>
        </div>

        <div class="component-demo">
          <div class="demo-title">Horizontal Navbar with Styled Buttons</div>
          <p class="text-muted mb-3">You can make the navbar horizontal and style the links as buttons using Lime CSS utilities:</p>

          <nav class="navbar d-flex align-items-center bg-light p-3 mb-4">
            <a class="navbar-brand d-flex align-items-center" href="#">
              <i class="fas fa-lemon text-lime mr-2"></i>
              Lime CSS
            </a>
            <ul class="navbar-nav d-flex flex-row ml-auto">
              <li class="mr-3">
                <a class="nav-link btn btn-primary btn-sm" href="#">Home</a>
              </li>
              <li class="mr-3">
                <a class="nav-link btn btn-secondary btn-sm" href="#">Features</a>
              </li>
              <li class="mr-3">
                <a class="nav-link btn btn-danger btn-sm" href="#">Pricing</a>
              </li>
              <li>
                <a class="nav-link btn btn-success btn-sm" href="#">Download</a>
              </li>
            </ul>
          </nav>

          <nav class="navbar d-flex align-items-center bg-dark p-3">
            <a class="navbar-brand text-white d-flex align-items-center" href="#">
              <i class="fas fa-leaf text-lime mr-2"></i>
              Lime UI
            </a>
            <ul class="navbar-nav d-flex flex-row ml-auto">
              <li class="mr-3 p-1">
                <a class="nav-link btn btn-outline-danger btn-sm" href="#">Home</a>
              </li>
              <li class="mr-3 p-1">
                <a class="nav-link btn btn-outline-light btn-sm" href="#">Features</a>
              </li>
              <li class="mr-3 p-1">
                <a class="nav-link btn btn-outline-info btn-sm" href="#">Docs</a>
              </li>
              <li class="p-1">
                <a class="nav-link btn btn-outline-warning btn-sm" href="#">Try Now</a>
              </li>
            </ul>
          </nav>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Basic Vertical Navbar (Default) --&gt;
&lt;nav class="navbar"&gt;
  &lt;a class="navbar-brand" href="#"&gt;Brand&lt;/a&gt;
  &lt;ul class="navbar-nav"&gt;
    &lt;li&gt;
      &lt;a class="nav-link active" href="#"&gt;Home&lt;/a&gt;
    &lt;/li&gt;
    &lt;li&gt;
      &lt;a class="nav-link" href="#"&gt;Features&lt;/a&gt;
    &lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;

&lt;!-- Horizontal Navbar with Button Links --&gt;
&lt;nav class="navbar d-flex align-items-center bg-light p-3"&gt;
  &lt;a class="navbar-brand" href="#"&gt;Brand&lt;/a&gt;
  &lt;ul class="navbar-nav d-flex flex-row ml-auto"&gt;
    &lt;li class="mr-3"&gt;
      &lt;a class="nav-link btn btn-primary btn-sm" href="#"&gt;Home&lt;/a&gt;
    &lt;/li&gt;
    &lt;li class="mr-3"&gt;
      &lt;a class="nav-link btn btn-outline-primary btn-sm" href="#"&gt;Features&lt;/a&gt;
    &lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;

&lt;!-- Navbar with Pill Buttons --&gt;
&lt;nav class="navbar d-flex align-items-center bg-white border p-3"&gt;
  &lt;a class="navbar-brand" href="#"&gt;Brand&lt;/a&gt;
  &lt;ul class="navbar-nav d-flex flex-row ml-auto"&gt;
    &lt;li class="mr-2"&gt;
      &lt;a class="nav-link btn btn-primary rounded-pill px-3" href="#"&gt;Home&lt;/a&gt;
    &lt;/li&gt;
    &lt;li class="mr-2"&gt;
      &lt;a class="nav-link btn btn-outline-primary rounded-pill px-3" href="#"&gt;Features&lt;/a&gt;
    &lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;</code></pre>
        </div>

        <h3>Navbar Classes</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><code>.navbar</code></td>
                <td>Base class for navigation bar. Sets display: flex, flex-wrap: wrap, aligns items center, and justifies content between.</td>
              </tr>
              <tr>
                <td><code>.navbar-brand</code></td>
                <td>For your company, product, or project name. Adds padding and font-size styling.</td>
              </tr>
              <tr>
                <td><code>.navbar-nav</code></td>
                <td>Container for navigation links. Default is flex-direction: column (vertical).</td>
              </tr>
              <tr>
                <td><code>.nav-link</code></td>
                <td>Individual navigation link. Sets display: block, padding, color (#007bff), and text decoration.</td>
              </tr>
              <tr>
                <td>
                  <code>.btn</code>
                  +
                  <code>.nav-link</code>
                </td>
                <td>Combination to style navigation links as buttons</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="callout">
          <p>
            <strong>Tip:</strong>
            To create button-style navigation links, combine the
            <code>.nav-link</code>
            class with button classes like
            <code>.btn</code>
            ,
            <code>.btn-primary</code>
            ,
            <code>.btn-sm</code>
            , and
            <code>.rounded-pill</code>
            . Use margin utilities like
            <code>.mr-2</code>
            or
            <code>.mr-3</code>
            for spacing between buttons.
          </p>
        </div>

        <div class="callout warning">
          <p>
            <strong>Important:</strong>
            The default navbar in Lime CSS is designed to be simple and lightweight. For complex navigation patterns (dropdowns, mobile menus, etc.), you'll need to write additional CSS or JavaScript.
          </p>
        </div>
      </section>

      <!-- Colors -->
      <section id="colors" class="section">
        <h2>Colors</h2>
        <p>Lime CSS includes a comprehensive color system with predefined classes for text, background, and border colors.</p>

        <h3>Text Colors</h3>
        <div class="component-demo">
          <p class="text-primary">.text-primary</p>
          <p class="text-secondary">.text-secondary</p>
          <p class="text-success">.text-success</p>
          <p class="text-danger">.text-danger</p>
          <p class="text-warning">.text-warning</p>
          <p class="text-info">.text-info</p>
          <p class="text-light bg-dark">.text-light (on dark background)</p>
          <p class="text-dark">.text-dark</p>
          <p class="text-muted">.text-muted</p>
          <p class="text-lime">
            .text-lime
            <span class="badge">Custom</span>
          </p>
        </div>

        <h3>Background Colors</h3>
        <div class="color-swatches">
          <div class="color-swatch">
            <div class="swatch bg-primary">Primary</div>
            <div class="info">
              <div class="name">Primary</div>
              <div class="value">#32cd32</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-secondary">Secondary</div>
            <div class="info">
              <div class="name">Secondary</div>
              <div class="value">#6c757d</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-success">Success</div>
            <div class="info">
              <div class="name">Success</div>
              <div class="value">#28a745</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-danger">Danger</div>
            <div class="info">
              <div class="name">Danger</div>
              <div class="value">#dc3545</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-warning light">Warning</div>
            <div class="info">
              <div class="name">Warning</div>
              <div class="value">#ffc107</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-info">Info</div>
            <div class="info">
              <div class="name">Info</div>
              <div class="value">#17a2b8</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-dark">Dark</div>
            <div class="info">
              <div class="name">Dark</div>
              <div class="value">#343a40</div>
            </div>
          </div>
          <div class="color-swatch">
            <div class="swatch bg-lime">
              Lime
              <span class="badge">Custom</span>
            </div>
            <div class="info">
              <div class="name">Lime</div>
              <div class="value">#32cd32</div>
            </div>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Text colors --&gt;
&lt;p class="text-primary"&gt;Primary text&lt;/p&gt;
&lt;p class="text-success"&gt;Success text&lt;/p&gt;

&lt;!-- Background colors --&gt;
&lt;div class="bg-primary text-white"&gt;Primary background&lt;/div&gt;
&lt;div class="bg-success text-white"&gt;Success background&lt;/div&gt;

&lt;!-- Border colors --&gt;
&lt;div class="border border-primary"&gt;Primary border&lt;/div&gt;
&lt;div class="border border-success"&gt;Success border&lt;/div&gt;</code></pre>
        </div>
      </section>

      <!-- Spacing -->
      <section id="spacing" class="section">
        <h2>Spacing</h2>
        <p>Lime CSS includes a wide range of shorthand responsive margin and padding utility classes to modify an element's appearance.</p>

        <div class="component-demo">
          <div class="demo-title">Margin Examples</div>
          <div class="p-3 mb-2 bg-light border">
            <div class="p-2 bg-primary text-white mb-3">.mb-3 (margin-bottom: 1rem)</div>
            <div class="p-2 bg-success text-white mt-3">.mt-3 (margin-top: 1rem)</div>
            <div class="p-2 bg-info text-white ml-3 d-inline-block">.ml-3</div>
            <div class="p-2 bg-warning text-white mr-3 d-inline-block">.mr-3</div>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Padding Examples</div>
          <div class="bg-light border">
            <div class="p-1 bg-primary text-white mb-2">.p-1 (padding: 0.25rem)</div>
            <div class="p-2 bg-success text-white mb-2">.p-2 (padding: 0.5rem)</div>
            <div class="p-3 bg-info text-white mb-2">.p-3 (padding: 1rem)</div>
            <div class="p-4 bg-warning text-white">.p-4 (padding: 1.5rem)</div>
          </div>
        </div>

        <h3>Spacing Scale</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Size</th>
                <th>Value</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <code>.m-1</code>
                  /
                  <code>.p-1</code>
                </td>
                <td>1</td>
                <td>0.25rem (4px)</td>
              </tr>
              <tr>
                <td>
                  <code>.m-2</code>
                  /
                  <code>.p-2</code>
                </td>
                <td>2</td>
                <td>0.5rem (8px)</td>
              </tr>
              <tr>
                <td>
                  <code>.m-3</code>
                  /
                  <code>.p-3</code>
                </td>
                <td>3</td>
                <td>1rem (16px)</td>
              </tr>
              <tr>
                <td>
                  <code>.m-4</code>
                  /
                  <code>.p-4</code>
                </td>
                <td>4</td>
                <td>1.5rem (24px)</td>
              </tr>
              <tr>
                <td>
                  <code>.m-5</code>
                  /
                  <code>.p-5</code>
                </td>
                <td>5</td>
                <td>3rem (48px)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Margin utilities --&gt;
&lt;div class="mt-3"&gt;Margin top 1rem&lt;/div&gt;
&lt;div class="mb-4"&gt;Margin bottom 1.5rem&lt;/div&gt;
&lt;div class="ml-2"&gt;Margin left 0.5rem&lt;/div&gt;
&lt;div class="mr-5"&gt;Margin right 3rem&lt;/div&gt;

&lt;!-- Padding utilities --&gt;
&lt;div class="pt-3"&gt;Padding top 1rem&lt;/div&gt;
&lt;div class="pb-4"&gt;Padding bottom 1.5rem&lt;/div&gt;
&lt;div class="pl-2"&gt;Padding left 0.5rem&lt;/div&gt;
&lt;div class="pr-5"&gt;Padding right 3rem&lt;/div&gt;</code></pre>
        </div>
      </section>

      <!-- Display -->
      <section id="display" class="section">
        <h2>Display</h2>
        <p>Quickly and responsively toggle the display value of components and more with our display utilities.</p>

        <div class="component-demo">
          <div class="demo-title">Display Examples</div>
          <div class="d-inline p-2 bg-primary text-white">d-inline</div>
          <div class="d-inline p-2 bg-success text-white">d-inline</div>

          <div class="d-block p-2 bg-info text-white mt-2">d-block</div>
          <div class="d-block p-2 bg-warning text-white">d-block</div>

          <div class="d-flex p-2 bg-light border mt-2">
            <div class="p-2 bg-primary text-white mr-2">Flex item</div>
            <div class="p-2 bg-success text-white">Flex item</div>
          </div>

          <div class="d-none p-2 bg-danger text-white mt-2">This is hidden (d-none)</div>
          <div class="d-inline-block p-2 bg-dark text-white mt-2">d-inline-block</div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;div class="d-inline"&gt;Inline&lt;/div&gt;
&lt;div class="d-block"&gt;Block&lt;/div&gt;
&lt;div class="d-flex"&gt;Flex&lt;/div&gt;
&lt;div class="d-inline-block"&gt;Inline Block&lt;/div&gt;
&lt;div class="d-none"&gt;Hidden&lt;/div&gt;

&lt;!-- Responsive display --&gt;
&lt;div class="d-none d-md-block"&gt;
  Hidden on mobile, visible on medium and up
&lt;/div&gt;</code></pre>
        </div>
      </section>

      <!-- Text -->
      <section id="text" class="section">
        <h2>Text</h2>
        <p>Text utilities for controlling alignment, wrapping, weight, and more.</p>

        <h3>Text Alignment</h3>
        <div class="component-demo">
          <div class="demo-title">Text Alignment Classes</div>
          <p class="text-left border p-3 mb-3">Left aligned text on all viewport sizes.</p>
          <p class="text-center border p-3 mb-3">Center aligned text on all viewport sizes.</p>
          <p class="text-right border p-3">Right aligned text on all viewport sizes.</p>
        </div>

        <div class="component-demo">
          <div class="demo-title">Responsive Text Alignment</div>
          <p class="text-left text-md-center text-lg-right border p-3 mb-3">Left aligned on small, center aligned on medium, right aligned on large.</p>
          <p class="text-center text-lg-left border p-3">Center aligned on small and medium, left aligned on large.</p>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;p class="text-left"&gt;Left aligned text&lt;/p&gt;
&lt;p class="text-center"&gt;Center aligned text&lt;/p&gt;
&lt;p class="text-right"&gt;Right aligned text&lt;/p&gt;
&lt;p class="text-justify"&gt;Justified text&lt;/p&gt;

&lt;!-- Responsive alignment --&gt;
&lt;p class="text-left text-md-center text-lg-right"&gt;
  Responsive text alignment
&lt;/p&gt;</code></pre>
        </div>

        <h3>Text Transformation</h3>
        <div class="component-demo">
          <div class="demo-title">Text Transformation Classes</div>
          <p class="text-lowercase border p-3 mb-3">LOWERCASE TEXT TRANSFORMED TO LOWERCASE</p>
          <p class="text-uppercase border p-3 mb-3">uppercase text transformed to uppercase</p>
          <p class="text-capitalize border p-3 mb-3">capitalized text transforms each word's first letter</p>
          <p class="font-normal border p-3 mb-3"><em>Italic text made normal with .font-normal</em></p>
          <p class="font-italic border p-3">Normal text made italic with .font-italic</p>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;p class="text-lowercase"&gt;Lowercased text&lt;/p&gt;
&lt;p class="text-uppercase"&gt;Uppercased text&lt;/p&gt;
&lt;p class="text-capitalize"&gt;Capitalized text&lt;/p&gt;
&lt;p class="font-italic"&gt;Italic text&lt;/p&gt;
&lt;p class="font-normal"&gt;Normal text (removes italic)&lt;/p&gt;</code></pre>
        </div>

        <h3>Font Weight and Style</h3>
        <div class="component-demo">
          <div class="demo-title">Font Weight Classes</div>
          <p class="font-weight-light border p-3 mb-3">Light weight text</p>
          <p class="font-weight-normal border p-3 mb-3">Normal weight text</p>
          <p class="font-weight-bold border p-3 mb-3">Bold weight text</p>
          <p class="font-italic border p-3 mb-3">Italic style text</p>
          <p class="font-italic font-weight-bold border p-3">Bold italic text</p>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;p class="font-weight-light"&gt;Light weight text&lt;/p&gt;
&lt;p class="font-weight-normal"&gt;Normal weight text&lt;/p&gt;
&lt;p class="font-weight-bold"&gt;Bold weight text&lt;/p&gt;
&lt;p class="font-italic"&gt;Italic text&lt;/p&gt;</code></pre>
        </div>

        <h3>Text Decoration and Overflow</h3>
        <div class="component-demo">
          <div class="demo-title">Text Decoration Classes</div>
          <p class="text-decoration-none border p-3 mb-3"><a href="#" class="text-decoration-none">Link without underline</a></p>
          <p class="text-decoration-underline border p-3 mb-3">Text with underline</p>

          <div class="demo-title mt-4">Text Overflow Classes</div>
          <div class="border p-3 mb-3">
            <p class="text-nowrap" style="width: 200px; background: #f8f9fa">This text will not wrap and will overflow the container.</p>
          </div>

          <div class="border p-3">
            <p class="text-truncate" style="max-width: 200px; background: #f8f9fa">This is a very long text that will be truncated with an ellipsis when it overflows.</p>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Text decoration --&gt;
&lt;a href="#" class="text-decoration-none"&gt;Link without underline&lt;/a&gt;
&lt;p class="text-decoration-underline"&gt;Underlined text&lt;/p&gt;

&lt;!-- Text overflow --&gt;
&lt;p class="text-nowrap"&gt;Non-wrapping text&lt;/p&gt;
&lt;p class="text-truncate" style="max-width: 200px;"&gt;
  Truncated long text
&lt;/p&gt;</code></pre>
        </div>

        <h3>Text Colors</h3>
        <div class="component-demo">
          <div class="demo-title">Text Color Classes</div>
          <p class="text-primary border p-3 mb-2">.text-primary</p>
          <p class="text-secondary border p-3 mb-2">.text-secondary</p>
          <p class="text-success border p-3 mb-2">.text-success</p>
          <p class="text-danger border p-3 mb-2">.text-danger</p>
          <p class="text-warning border p-3 mb-2">.text-warning</p>
          <p class="text-info border p-3 mb-2">.text-info</p>
          <p class="text-light bg-dark border p-3 mb-2">.text-light (on dark background)</p>
          <p class="text-dark border p-3 mb-2">.text-dark</p>
          <p class="text-muted border p-3 mb-2">.text-muted</p>
          <p class="text-lime border p-3">
            .text-lime
            <span class="badge">Custom</span>
          </p>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;p class="text-primary"&gt;Primary text&lt;/p&gt;
&lt;p class="text-secondary"&gt;Secondary text&lt;/p&gt;
&lt;p class="text-success"&gt;Success text&lt;/p&gt;
&lt;p class="text-danger"&gt;Danger text&lt;/p&gt;
&lt;p class="text-warning"&gt;Warning text&lt;/p&gt;
&lt;p class="text-info"&gt;Info text&lt;/p&gt;
&lt;p class="text-light bg-dark"&gt;Light text&lt;/p&gt;
&lt;p class="text-dark"&gt;Dark text&lt;/p&gt;
&lt;p class="text-muted"&gt;Muted text&lt;/p&gt;
&lt;p class="text-lime"&gt;Lime text&lt;/p&gt;</code></pre>
        </div>

        <h3>Text Utilities Reference</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><code>.text-left</code></td>
                <td>Left aligned text</td>
              </tr>
              <tr>
                <td><code>.text-center</code></td>
                <td>Center aligned text</td>
              </tr>
              <tr>
                <td><code>.text-right</code></td>
                <td>Right aligned text</td>
              </tr>
              <tr>
                <td><code>.text-justify</code></td>
                <td>Justified text</td>
              </tr>
              <tr>
                <td><code>.text-lowercase</code></td>
                <td>Lowercase text</td>
              </tr>
              <tr>
                <td><code>.text-uppercase</code></td>
                <td>Uppercase text</td>
              </tr>
              <tr>
                <td><code>.text-capitalize</code></td>
                <td>Capitalized text (first letter of each word)</td>
              </tr>
              <tr>
                <td><code>.font-weight-light</code></td>
                <td>Light font weight (300)</td>
              </tr>
              <tr>
                <td><code>.font-weight-normal</code></td>
                <td>Normal font weight (400)</td>
              </tr>
              <tr>
                <td><code>.font-weight-bold</code></td>
                <td>Bold font weight (700)</td>
              </tr>
              <tr>
                <td><code>.font-italic</code></td>
                <td>Italic text</td>
              </tr>
              <tr>
                <td><code>.font-normal</code></td>
                <td>Normal font style (removes italic)</td>
              </tr>
              <tr>
                <td><code>.text-nowrap</code></td>
                <td>Prevent text from wrapping</td>
              </tr>
              <tr>
                <td><code>.text-truncate</code></td>
                <td>Truncate text with ellipsis</td>
              </tr>
              <tr>
                <td><code>.text-decoration-none</code></td>
                <td>Remove text decoration (underline)</td>
              </tr>
              <tr>
                <td><code>.text-decoration-underline</code></td>
                <td>Add underline to text</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="callout">
          <p>
            <strong>Tip:</strong>
            Text utility classes can be combined with responsive breakpoints. For example, use
            <code>.text-center .text-md-left</code>
            to center text on mobile and left-align it on medium screens and up.
          </p>
        </div>

        <div class="callout info">
          <p>
            <strong>Note:</strong>
            Lime CSS text utilities work with the default font stack: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif.
          </p>
        </div>
      </section>

      <!-- Borders -->
      <section id="borders" class="section">
        <h2>Borders</h2>
        <p>Use border utilities to quickly style the border and border-color of an element.</p>

        <div class="component-demo">
          <div class="demo-title">Border Styles</div>
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <div class="p-3 mb-2 border">.border (all sides)</div>
              <div class="p-3 mb-2 border-top">.border-top</div>
              <div class="p-3 mb-2 border-right">.border-right</div>
              <div class="p-3 mb-2 border-bottom">.border-bottom</div>
              <div class="p-3 border-left">.border-left</div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="p-3 mb-2 border border-0">.border.border-0 (no border)</div>
              <div class="p-3 mb-2 border border-top-0">.border.border-top-0</div>
              <div class="p-3 mb-2 border border-right-0">.border.border-right-0</div>
              <div class="p-3 mb-2 border border-bottom-0">.border.border-bottom-0</div>
              <div class="p-3 border border-left-0">.border.border-left-0</div>
            </div>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Border Colors</div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="p-3 mb-2 border border-primary">.border.border-primary</div>
              <div class="p-3 mb-2 border border-secondary">.border.border-secondary</div>
              <div class="p-3 mb-2 border border-success">.border.border-success</div>
              <div class="p-3 mb-2 border border-danger">.border.border-danger</div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="p-3 mb-2 border border-warning">.border.border-warning</div>
              <div class="p-3 mb-2 border border-info">.border.border-info</div>
              <div class="p-3 mb-2 border border-light bg-dark">.border.border-light (on dark bg)</div>
              <div class="p-3 mb-2 border border-dark">.border.border-dark</div>
              <div class="p-3 border border-lime">
                .border.border-lime
                <span class="badge">Custom</span>
              </div>
            </div>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Border sides --&gt;
&lt;div class="border"&gt;All borders&lt;/div&gt;
&lt;div class="border-top"&gt;Top border&lt;/div&gt;
&lt;div class="border-right"&gt;Right border&lt;/div&gt;
&lt;div class="border-bottom"&gt;Bottom border&lt;/div&gt;
&lt;div class="border-left"&gt;Left border&lt;/div&gt;

&lt;!-- Remove borders --&gt;
&lt;div class="border border-0"&gt;No border&lt;/div&gt;
&lt;div class="border border-top-0"&gt;No top border&lt;/div&gt;

&lt;!-- Border colors --&gt;
&lt;div class="border border-primary"&gt;Primary border&lt;/div&gt;
&lt;div class="border border-success"&gt;Success border&lt;/div&gt;
&lt;div class="border border-danger"&gt;Danger border&lt;/div&gt;
&lt;div class="border border-warning"&gt;Warning border&lt;/div&gt;</code></pre>
        </div>

        <h3>Border Classes</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><code>.border</code></td>
                <td>Adds border to all sides</td>
              </tr>
              <tr>
                <td><code>.border-top</code></td>
                <td>Adds border to top only</td>
              </tr>
              <tr>
                <td><code>.border-right</code></td>
                <td>Adds border to right only</td>
              </tr>
              <tr>
                <td><code>.border-bottom</code></td>
                <td>Adds border to bottom only</td>
              </tr>
              <tr>
                <td><code>.border-left</code></td>
                <td>Adds border to left only</td>
              </tr>
              <tr>
                <td><code>.border-0</code></td>
                <td>Removes all borders</td>
              </tr>
              <tr>
                <td><code>.border-top-0</code></td>
                <td>Removes top border</td>
              </tr>
              <tr>
                <td><code>.border-right-0</code></td>
                <td>Removes right border</td>
              </tr>
              <tr>
                <td><code>.border-bottom-0</code></td>
                <td>Removes bottom border</td>
              </tr>
              <tr>
                <td><code>.border-left-0</code></td>
                <td>Removes left border</td>
              </tr>
              <tr>
                <td><code>.border-primary</code></td>
                <td>Sets border color to primary</td>
              </tr>
              <tr>
                <td><code>.border-secondary</code></td>
                <td>Sets border color to secondary</td>
              </tr>
              <tr>
                <td><code>.border-success</code></td>
                <td>Sets border color to success</td>
              </tr>
              <tr>
                <td><code>.border-danger</code></td>
                <td>Sets border color to danger</td>
              </tr>
              <tr>
                <td><code>.border-warning</code></td>
                <td>Sets border color to warning</td>
              </tr>
              <tr>
                <td><code>.border-info</code></td>
                <td>Sets border color to info</td>
              </tr>
              <tr>
                <td><code>.border-light</code></td>
                <td>Sets border color to light</td>
              </tr>
              <tr>
                <td><code>.border-dark</code></td>
                <td>Sets border color to dark</td>
              </tr>
              <tr>
                <td><code>.border-lime</code></td>
                <td>
                  Sets border color to lime
                  <span class="badge">Custom</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Rounded -->
      <section id="rounded" class="section">
        <h2>Rounded</h2>
        <p>Add rounded corners to elements with rounded utilities.</p>

        <div class="component-demo">
          <div class="demo-title">Rounded Corners</div>
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <div class="p-3 mb-2 bg-light border rounded">.rounded (default)</div>
              <div class="p-3 mb-2 bg-light border rounded-sm">.rounded-sm (smaller)</div>
              <div class="p-3 mb-2 bg-light border rounded-lg">.rounded-lg (larger)</div>
              <div class="p-3 mb-2 bg-light border rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px">.rounded-circle</div>
              <div class="p-3 bg-light border rounded-pill">.rounded-pill</div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="p-3 mb-2 bg-light border rounded-0">.rounded-0 (no rounding)</div>
              <div class="p-3 mb-2 bg-light border rounded-top">.rounded-top</div>
              <div class="p-3 mb-2 bg-light border rounded-bottom">.rounded-bottom</div>
              <div class="p-3 mb-2 bg-light border rounded-left">.rounded-left</div>
              <div class="p-3 bg-light border rounded-right">.rounded-right</div>
            </div>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Rounded Examples with Colors</div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="p-3 bg-primary text-white rounded mb-2">Primary rounded</div>
              <div class="p-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px">Circle</div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="p-3 bg-danger text-white rounded-pill mb-2">Danger pill</div>
              <div class="p-3 bg-warning rounded-lg">Warning large rounded</div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="p-3 bg-info text-white rounded-sm">Info small rounded</div>
              <div class="p-3 bg-dark text-white rounded-top">Dark top rounded</div>
            </div>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Rounded corners --&gt;
&lt;div class="rounded"&gt;Default rounded&lt;/div&gt;
&lt;div class="rounded-sm"&gt;Small rounded&lt;/div&gt;
&lt;div class="rounded-lg"&gt;Large rounded&lt;/div&gt;
&lt;div class="rounded-circle"&gt;Circle&lt;/div&gt;
&lt;div class="rounded-pill"&gt;Pill shape&lt;/div&gt;
&lt;div class="rounded-0"&gt;No rounding&lt;/div&gt;

&lt;!-- Specific sides --&gt;
&lt;div class="rounded-top"&gt;Top rounded&lt;/div&gt;
&lt;div class="rounded-bottom"&gt;Bottom rounded&lt;/div&gt;
&lt;div class="rounded-left"&gt;Left rounded&lt;/div&gt;
&lt;div class="rounded-right"&gt;Right rounded&lt;/div&gt;</code></pre>
        </div>

        <h3>Rounded Classes</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><code>.rounded</code></td>
                <td>Adds 0.25rem border-radius to all corners</td>
              </tr>
              <tr>
                <td><code>.rounded-sm</code></td>
                <td>Adds 0.2rem border-radius (smaller)</td>
              </tr>
              <tr>
                <td><code>.rounded-lg</code></td>
                <td>Adds 0.3rem border-radius (larger)</td>
              </tr>
              <tr>
                <td><code>.rounded-circle</code></td>
                <td>Makes element circular (50% border-radius)</td>
              </tr>
              <tr>
                <td><code>.rounded-pill</code></td>
                <td>Makes element pill-shaped (50rem border-radius)</td>
              </tr>
              <tr>
                <td><code>.rounded-0</code></td>
                <td>Removes border-radius (square corners)</td>
              </tr>
              <tr>
                <td><code>.rounded-top</code></td>
                <td>Rounds top-left and top-right corners</td>
              </tr>
              <tr>
                <td><code>.rounded-bottom</code></td>
                <td>Rounds bottom-left and bottom-right corners</td>
              </tr>
              <tr>
                <td><code>.rounded-left</code></td>
                <td>Rounds top-left and bottom-left corners</td>
              </tr>
              <tr>
                <td><code>.rounded-right</code></td>
                <td>Rounds top-right and bottom-right corners</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Shadows -->
      <section id="shadows" class="section">
        <h2>Shadows</h2>
        <p>Add or remove shadows to elements with box-shadow utilities.</p>

        <div class="component-demo">
          <div class="demo-title">Shadow Examples</div>
          <div class="row mb-4">
            <div class="col-md-4 mb-3">
              <div class="p-4 mb-2 bg-white shadow-none border">.shadow-none</div>
              <div class="p-4 bg-white shadow-sm">.shadow-sm (small shadow)</div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="p-4 mb-2 bg-white shadow">.shadow (regular shadow)</div>
              <div class="p-4 bg-white shadow-lg">.shadow-lg (large shadow)</div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="p-4 mb-2 bg-primary text-white shadow">Primary with shadow</div>
              <div class="p-4 bg-success text-white shadow-lg">Success with large shadow</div>
            </div>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Shadow on Hover Example</div>
          <p class="text-muted mb-3">Add shadow on hover with custom CSS:</p>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="p-4 bg-white border rounded transition shadow-hover" style="transition: all 0.3s ease; cursor: pointer" onmouseover="this.classList.add('shadow')" onmouseout="this.classList.remove('shadow')">Hover over me to see shadow</div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="p-4 bg-primary text-white border rounded transition shadow-hover" style="transition: all 0.3s ease; cursor: pointer" onmouseover="this.classList.add('shadow-lg')" onmouseout="this.classList.remove('shadow-lg')">Hover for large shadow</div>
            </div>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Shadow utilities --&gt;
&lt;div class="shadow-none"&gt;No shadow&lt;/div&gt;
&lt;div class="shadow-sm"&gt;Small shadow&lt;/div&gt;
&lt;div class="shadow"&gt;Regular shadow&lt;/div&gt;
&lt;div class="shadow-lg"&gt;Large shadow&lt;/div&gt;

&lt;!-- Example with colored background --&gt;
&lt;div class="bg-primary text-white shadow"&gt;Colored with shadow&lt;/div&gt;

&lt;!-- Shadow on hover (custom implementation) --&gt;
&lt;div class="shadow-hover" 
     onmouseover="this.classList.add('shadow')"
     onmouseout="this.classList.remove('shadow')"&gt;
  Hover me
&lt;/div&gt;</code></pre>
        </div>

        <h3>Shadow Classes</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Class</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><code>.shadow-none</code></td>
                <td>Removes any box shadow</td>
              </tr>
              <tr>
                <td><code>.shadow-sm</code></td>
                <td>Adds small shadow (0.125rem blur)</td>
              </tr>
              <tr>
                <td><code>.shadow</code></td>
                <td>Adds regular shadow (0.5rem blur)</td>
              </tr>
              <tr>
                <td><code>.shadow-lg</code></td>
                <td>Adds large shadow (1rem blur)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="callout info">
          <p>
            <strong>Note:</strong>
            Shadows work well with rounded corners and colored backgrounds. Combine
            <code>.shadow</code>
            with
            <code>.rounded</code>
            and background color classes for enhanced visual effects.
          </p>
        </div>
      </section>

      <!-- Responsive -->
      <section id="responsive" class="section">
        <h2>Responsive Utilities</h2>
        <p>Lime CSS includes responsive utility classes for showing/hiding content based on screen size.</p>

        <div class="component-demo">
          <div class="demo-title">Display Based on Screen Size</div>
          <div class="row mb-4">
            <div class="col-12 mb-3">
              <div class="p-3 bg-primary text-white d-none d-sm-block">Visible on small screens and up (hidden on xs)</div>
            </div>
            <div class="col-12 mb-3">
              <div class="p-3 bg-success text-white d-block d-md-none">Visible only on small screens (hidden on md and up)</div>
            </div>
            <div class="col-12 mb-3">
              <div class="p-3 bg-danger text-white d-none d-lg-block">Visible only on large screens and up</div>
            </div>
            <div class="col-12">
              <div class="p-3 bg-warning d-none d-md-block d-lg-none">Visible only on medium screens (hidden on small and large)</div>
            </div>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Responsive Text Alignment</div>
          <div class="row mb-4">
            <div class="col-12">
              <p class="p-3 bg-light border text-left text-md-center text-lg-right">Left on mobile, center on medium, right on large</p>
            </div>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Responsive Flex Utilities</div>
          <div class="row mb-4">
            <div class="col-12">
              <div class="d-flex flex-column flex-md-row p-3 bg-light border">
                <div class="p-2 bg-primary text-white mb-2 mb-md-0 mr-md-2">Flex item 1</div>
                <div class="p-2 bg-success text-white mr-md-2">Flex item 2</div>
                <div class="p-2 bg-danger text-white">Flex item 3</div>
              </div>
            </div>
          </div>
        </div>

        <div class="code-block">
          <pre><code class="language-html">&lt;!-- Responsive display --&gt;
&lt;div class="d-none d-sm-block"&gt;Hidden on xs, visible on sm+&lt;/div&gt;
&lt;div class="d-block d-md-none"&gt;Visible only on xs and sm&lt;/div&gt;
&lt;div class="d-none d-lg-block"&gt;Visible only on lg+&lt;/div&gt;

&lt;!-- Responsive text alignment --&gt;
&lt;p class="text-left text-md-center text-lg-right"&gt;
  Responsive text alignment
&lt;/p&gt;

&lt;!-- Responsive flex --&gt;
&lt;div class="d-flex flex-column flex-md-row"&gt;
  &lt;div&gt;Column on mobile, row on medium+&lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h3>Breakpoints</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Breakpoint</th>
                <th>Class Prefix</th>
                <th>Dimensions</th>
                <th>Example</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Extra small</td>
                <td><code>xs</code></td>
                <td>&lt;576px</td>
                <td><code>.d-block .d-sm-none</code></td>
              </tr>
              <tr>
                <td>Small</td>
                <td><code>sm</code></td>
                <td>≥576px</td>
                <td><code>.d-sm-block</code></td>
              </tr>
              <tr>
                <td>Medium</td>
                <td><code>md</code></td>
                <td>≥768px</td>
                <td><code>.d-md-none</code></td>
              </tr>
              <tr>
                <td>Large</td>
                <td><code>lg</code></td>
                <td>≥992px</td>
                <td><code>.d-lg-inline</code></td>
              </tr>
              <tr>
                <td>Extra large</td>
                <td><code>xl</code></td>
                <td>≥1200px</td>
                <td><code>.d-xl-flex</code></td>
              </tr>
              <tr>
                <td>Extra extra large</td>
                <td><code>xxl</code></td>
                <td>≥1200px</td>
                <td><code>.d-xxl-block</code></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="callout">
          <p>
            <strong>Tip:</strong>
            Use the mobile-first approach. Style for mobile first, then use responsive classes to adjust for larger screens. For example,
            <code>.d-block .d-md-none</code>
            shows an element on mobile but hides it on medium screens and up.
          </p>
        </div>
      </section>

      <!-- Customization -->
      <section id="customization" class="section">
        <h2>Customization</h2>
        <p>Learn how to customize Lime CSS to match your design needs.</p>

        <div class="component-demo">
          <div class="demo-title">CSS Variables Version</div>
          <p class="mb-3">
            Lime CSS includes a CSS variables version (
            <code>lime-variables.css</code>
            ) that allows easy customization:
          </p>

          <div class="code-block">
            <pre><code class="language-css">/* Using CSS variables version */
:root {
  --lime-primary: #32cd32;
  --lime-primary-dark: #28a428;
  --lime-primary-light: #80d080;
  
  /* Override default variables */
  --border-radius: 0.5rem;
  --box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
}</code></pre>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Custom Build with SASS (Example)</div>
          <p class="mb-3">If you're using SASS, you can customize the framework:</p>

          <div class="code-block">
            <pre><code class="language-scss">// Custom variables
$primary: #4CAF50;
$border-radius: 0.5rem;
$spacer: 1.5rem;

// Import Lime CSS
@import "lime.scss";

// Your custom styles
.custom-class {
  background-color: lighten($primary, 20%);
}</code></pre>
          </div>
        </div>

        <div class="component-demo">
          <div class="demo-title">Overriding Styles</div>
          <p class="mb-3">You can override default styles by adding your own CSS after Lime CSS:</p>

          <div class="code-block">
            <pre><code class="language-css">/* Override primary color */
.btn-primary {
  background-color: #4CAF50;
  border-color: #4CAF50;
}

.btn-primary:hover {
  background-color: #45a049;
  border-color: #45a049;
}

/* Custom rounded corners */
.rounded {
  border-radius: 0.5rem !important;
}

/* Add custom shadow */
.shadow-custom {
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
}</code></pre>
          </div>
        </div>

        <h3>Customization Options</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Feature</th>
                <th>Customization Method</th>
                <th>Example</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Colors</td>
                <td>CSS variables or override classes</td>
                <td><code>--lime-primary: #4CAF50;</code></td>
              </tr>
              <tr>
                <td>Spacing</td>
                <td>Override SASS variables or CSS variables</td>
                <td><code>--spacer: 1.5rem;</code></td>
              </tr>
              <tr>
                <td>Border Radius</td>
                <td>CSS variables</td>
                <td><code>--border-radius: 0.5rem;</code></td>
              </tr>
              <tr>
                <td>Shadows</td>
                <td>Override CSS variables</td>
                <td><code>--box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);</code></td>
              </tr>
              <tr>
                <td>Typography</td>
                <td>Override CSS variables</td>
                <td><code>--font-family-sans-serif: 'Inter', sans-serif;</code></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="callout info">
          <p>
            <strong>Note:</strong>
            When customizing, make sure to load your custom CSS after Lime CSS to ensure your styles take precedence. For major customizations, consider using the SASS version if available.
          </p>
        </div>

        <div class="callout warning">
          <p>
            <strong>Important:</strong>
            Always test your customizations across different browsers and devices to ensure consistency.
          </p>
        </div>
      </section>

      <!-- Changelog -->
      <!-- Changelog -->
      <section id="changelog" class="section">
        <h2>Changelog</h2>
        <p>Version history and updates for Lime CSS Framework.</p>

        <!-- Version 1.0.0 -->
        <div class="changelog-component">
          <div class="version-header">
            <h3 class="version-title">Version 1.0.0</h3>
            <span class="version-badge badge-latest">Latest</span>
          </div>

          <p class="release-info">
            <strong class="release-date">Released:</strong>
            December 2025
          </p>

          <div class="features-section">
            <h4 class="section-title">New Features</h4>
            <ul class="feature-list">
              <li class="feature-item">Initial release of Lime CSS Framework</li>
              <li class="feature-item">Complete set of utility classes</li>
              <li class="feature-item">Responsive 12-column grid system</li>
              <li class="feature-item">Components: Buttons, Forms, Tables, Alerts, Navbar</li>
              <li class="feature-item">Custom lime-themed color scheme</li>
              <li class="feature-item">Comprehensive documentation</li>
            </ul>
          </div>

          <div class="features-section">
            <h4 class="section-title">Breaking Changes</h4>
            <ul class="feature-list">
              <li class="feature-item">None (initial release)</li>
            </ul>
          </div>

          <div class="features-section">
            <h4 class="section-title">Bug Fixes</h4>
            <ul class="feature-list">
              <li class="feature-item">None (initial release)</li>
            </ul>
          </div>
        </div>

        <!-- Upcoming Features -->
        <div class="changelog-component">
          <div class="version-header">
            <h3 class="version-title">Upcoming Features</h3>
            <span class="version-badge badge-planned">Planned</span>
          </div>

          <div class="features-section">
            <h4 class="section-title">Version 1.1.0 (Planned)</h4>
            <ul class="feature-list">
              <li class="feature-item">Dropdown components</li>
              <li class="feature-item">Modal dialogs</li>
              <li class="feature-item">Tooltips and popovers</li>
              <li class="feature-item">Carousel/slider component</li>
              <li class="feature-item">Dark mode support</li>
              <li class="feature-item">Additional form components</li>
            </ul>
          </div>

          <div class="features-section">
            <h4 class="section-title">Version 2.0.0 (Future)</h4>
            <ul class="feature-list">
              <li class="feature-item">SASS/SCSS source files</li>
              <li class="feature-item">JavaScript plugins for interactive components</li>
              <li class="feature-item">Extended color system</li>
              <li class="feature-item">Theme builder tool</li>
              <li class="feature-item">More layout options</li>
            </ul>
          </div>
        </div>

        <!-- Migration Guide -->
        <div class="changelog-component">
          <div class="version-header">
            <h3 class="version-title">Migration Guide</h3>
          </div>

          <p class="mb-3">Since this is the first version, there are no migration steps. Future versions will include migration guides here.</p>

          <div class="changelog-callout callout-note">
            <p>
              <strong>Stay Updated:</strong>
              Check back here for updates or follow the project on GitHub for the latest news and releases.
            </p>
          </div>
        </div>

        <!-- Code Block -->
        <div class="changelog-component">
          <div class="version-code">
            <pre><code class="language-html">&lt;!-- Current version --&gt;
&lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lime-css@1.0.0/dist/lime.min.css"&gt;

&lt;!-- Always check for latest version --&gt;
&lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lime-css/dist/lime.min.css"&gt;</code></pre>
          </div>
        </div>

        <!-- Version Support Table -->
        <div class="changelog-component">
          <h3 class="section-title">Version Support</h3>
          <table class="support-table">
            <thead>
              <tr>
                <th>Version</th>
                <th>Status</th>
                <th>Release Date</th>
                <th>Support Ends</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.0.x</td>
                <td class="status-active">Active</td>
                <td>Dec 2025</td>
                <td>Dec 2026</td>
              </tr>
              <tr>
                <td>0.x.x</td>
                <td class="status-deprecated">Deprecated</td>
                <td>N/A</td>
                <td>N/A</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Semantic Versioning Note -->
        <div class="changelog-component">
          <div class="changelog-callout callout-note">
            <p>
              <strong>Note:</strong>
              Lime CSS follows semantic versioning. Patch versions (1.0.x) contain bug fixes, minor versions (1.x.0) add new features, and major versions (x.0.0) may include breaking changes.
            </p>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer class="footer">
        <p>
          Lime CSS Framework v1.0.0 • Created by
          <a href="https://obydullah.com" target="_blank">Shaik Obydullah</a>
        </p>
        <p class="mt-2">Released under the MIT License • © 2025</p>
      </footer>
    </main>

    <!-- Back to Top -->
    <a href="#" class="back-to-top" id="backToTop">
      <i class="fas fa-arrow-up"></i>
    </a>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Mobile menu toggle
        const menuToggle = document.getElementById("menuToggle");
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");

        function toggleSidebar() {
          sidebar.classList.toggle("active");
          sidebarOverlay.classList.toggle("active");
        }

        if (menuToggle) {
          menuToggle.addEventListener("click", toggleSidebar);
        }

        if (sidebarOverlay) {
          sidebarOverlay.addEventListener("click", toggleSidebar);
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
          anchor.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href");

            // Handle back-to-top link
            if (targetId === "#") {
              e.preventDefault();
              window.scrollTo({
                top: 0,
                behavior: "smooth",
              });
              return;
            }

            // Handle regular section links (your existing code)
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
              // Update active nav link
              document.querySelectorAll(".sidebar-nav a").forEach((link) => {
                link.classList.remove("active");
              });
              this.classList.add("active");

              // Close sidebar on mobile
              if (window.innerWidth < 992) {
                toggleSidebar();
              }

              // Scroll to section
              window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: "smooth",
              });
            }
          });
        });
        // Back to top button
        const backToTop = document.getElementById("backToTop");

        window.addEventListener("scroll", function () {
          if (window.pageYOffset > 300) {
            backToTop.style.display = "flex";
          } else {
            backToTop.style.display = "none";
          }

          // Update active nav link based on scroll position
          const sections = document.querySelectorAll(".section");
          let current = "";

          sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= sectionTop - 150) {
              current = section.getAttribute("id");
            }
          });

          document.querySelectorAll(".sidebar-nav a").forEach((link) => {
            link.classList.remove("active");
            if (link.getAttribute("href") === `#${current}`) {
              link.classList.add("active");
            }
          });
        });

        // Copy code blocks
        document.querySelectorAll(".code-block").forEach((block) => {
          block.addEventListener("click", function () {
            const code = this.querySelector("code").innerText;
            navigator.clipboard.writeText(code).then(() => {
              const original = this.style.boxShadow;
              this.style.boxShadow = "0 0 0 3px rgba(50, 205, 50, 0.3)";
              setTimeout(() => {
                this.style.boxShadow = original;
              }, 500);
            });
          });
        });

        // Initialize
        backToTop.style.display = "none";
      });
    </script>
  </body>
</html>
