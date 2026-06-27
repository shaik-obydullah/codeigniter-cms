<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shaik Obydullah - Professional Timeline</title>
    <style>
      :root {
        --primary: #3498db;
        --secondary: #2ecc71;
        --dark: #2c3e50;
        --light: #ecf0f1;
        --highlight: #f39c12;
      }

      body,
      h1,
      h2,
      h3,
      p,
      ul {
        margin: 0;
        padding: 0;
      }

      body {
        font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f9f9f9;
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
      }

      header {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
      }

      h1 {
        color: var(--dark);
        font-size: 1.8rem;
        line-height: 1.2;
        margin: 0;
      }

      h2 {
        color: var(--primary);
        border-left: 4px solid var(--primary);
        padding-left: 10px;
        margin-bottom: 15px;
      }

      h3 {
        margin-top: 0;
        margin-bottom: 8px;
      }

      .timeline {
        position: relative;
        padding-left: 30px;
      }

      .timeline:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--primary);
      }

      .timeline-item {
        position: relative;
        margin-bottom: 30px;
        padding: 20px;
        background: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      }

      .timeline-dot {
        position: absolute;
        left: -36px;
        top: 25px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
      }

      .work {
        background: white;
      }
      .education {
        background: #daf9e7;
      }
      .tech {
        background: #bcc894;
      }
      .certification {
        background: #eaeaea;
      }

      .timeline-date {
        font-weight: bold;
        color: var(--dark);
        display: block;
        margin-bottom: 5px;
      }

      .tech-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 10px 0;
      }

      .tag {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
      }

      .backend {
        background: #d4edff;
        color: var(--primary);
      }
      .frontend {
        background: #d4f7e3;
        color: var(--secondary);
      }
      .devops {
        background: #96f058;
        color: #000;
      }
      .database {
        background: #e8d4ff;
        color: #9b59b6;
      }

      section {
        margin-bottom: 30px;
      }

      ul {
        margin-left: 20px;
        margin-bottom: 10px;
      }

      li {
        margin-bottom: 6px;
      }
    </style>
  </head>
  <body>
    <header>
      <div>
        <h1>Shaik Obydullah</h1>
        <p>Full Stack Developer | Backend & Frontend | DevOps & Cloud</p>
      </div>
    </header>

    <section>
      <h2>My Career Timeline</h2>
      <div class="timeline">
        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">June 2025 - August 2025</span>
          <h3>CI/CD Pipelines</h3>
          <p>Implementing continuous integration and deployment workflows</p>
          <div class="tech-tags">
            <span class="tag devops">GitHub Actions</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">May 2025</span>
          <h3>Docker Containerization</h3>
          <p>Mastering container deployment and orchestration</p>
          <div class="tech-tags">
            <span class="tag devops">Docker</span>
            <span class="tag devops">Docker Swarm</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">April 2025</span>
          <h3>Alpine JS & AWS</h3>
          <p>Lightweight JavaScript framework and cloud services</p>
          <div class="tech-tags">
            <span class="tag devops">Alpine JS</span>
            <span class="tag devops">AWS</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">March 2025</span>
          <h3>Next.js Framework</h3>
          <p>Server-side React framework for production applications</p>
          <div class="tech-tags">
            <span class="tag devops">Next.js</span>
            <span class="tag devops">React</span>
          </div>
        </div>
      </div>
    </section>

    <section>
      <h2>Education & Certifications</h2>
      <div class="timeline">
        <div class="timeline-item education">
          <div class="timeline-dot education"></div>
          <span class="timeline-date">January 2025</span>
          <h3>MSc in Computing and Information Systems</h3>
          <p>University of South Wales, United Kingdom | Result: Merit</p>
          <div class="tech-tags">
            <span class="tag">Software Development</span>
            <span class="tag">ICT Systems</span>
            <span class="tag">Big Data</span>
            <span class="tag">Security Management</span>
            <span class="tag">Project Management</span>
          </div>
        </div>

        <div class="timeline-item education">
          <div class="timeline-dot education"></div>
          <span class="timeline-date">Completed 2020</span>
          <h3>MSc in Computer Science and Engineering</h3>
          <p>The People's University of Bangladesh | Result: 3.71</p>
        </div>

        <div class="timeline-item education">
          <div class="timeline-dot education"></div>
          <span class="timeline-date">Completed 2016</span>
          <h3>BSc in Computer Science and Engineering</h3>
          <p>Bangladesh University of Business and Technology | Result: 2.92</p>
        </div>

        <div class="timeline-item certification">
          <div class="timeline-dot certification"></div>
          <span class="timeline-date">April 2025</span>
          <h3>Web Application Development - PHP</h3>
          <p>Bangladesh Association of Software and Information Services (BASIS)</p>
        </div>

        <div class="timeline-item certification">
          <div class="timeline-dot certification"></div>
          <span class="timeline-date">May 2014</span>
          <h3>OOP (MVC) PHP with CodeIgniter Framework</h3>
          <p>BASIS Institute of Technology & Management Limited (BITM), Bangladesh</p>
        </div>

        <div class="timeline-item certification">
          <div class="timeline-dot certification"></div>
          <span class="timeline-date">June 2013</span>
          <h3>Search Engine Optimization and E-Marketing</h3>
          <p>Daffodil International University</p>
        </div>
      </div>
    </section>

    <section>
      <h2>Professional Experience</h2>
      <div class="timeline">
        <div class="timeline-item work">
          <div class="timeline-dot work"></div>
          <span class="timeline-date">May 2023 - July 2023</span>
          <h3>Senior Executive ERP</h3>
          <p>National Development Engineers, Dhaka, Bangladesh</p>
          <ul>
            <li>Developed stock adjustment modules using FrontAccounting ERP</li>
            <li>Improved inventory tracking accuracy by 20%</li>
          </ul>
        </div>

        <div class="timeline-item work">
          <div class="timeline-dot work"></div>
          <span class="timeline-date">Nov 2022 - Apr 2023</span>
          <h3>Senior Laravel Developer</h3>
          <p>Ekopii, Dhaka, Bangladesh</p>
          <ul>
            <li>Created trading platform using Binance Future API</li>
            <li>Integrated Laravel for trading and wallet functionalities</li>
          </ul>
        </div>

        <div class="timeline-item work">
          <div class="timeline-dot work"></div>
          <span class="timeline-date">Nov 2017 - May 2022</span>
          <h3>Software Engineer → Senior Software Engineer</h3>
          <p>3Devs IT Limited, Dhaka, Bangladesh</p>
          <ul>
            <li>Developed web applications using PHP frameworks</li>
            <li>Created management systems for various clients</li>
          </ul>
        </div>

        <div class="timeline-item work">
          <div class="timeline-dot work"></div>
          <span class="timeline-date">Jun 2016 - Oct 2017</span>
          <h3>Web Developer</h3>
          <p>LabTrio IT Limited, Dhaka, Bangladesh</p>
          <ul>
            <li>Developed websites using CodeIgniter Framework</li>
          </ul>
        </div>
      </div>
    </section>

    <section>
      <h2>Technical Skills Timeline</h2>
      <div class="timeline">
        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Dec 2024 - Feb 2025</span>
          <h3>ERPBI Development</h3>
          <p>Enterprise Resource Planning with Business Intelligence</p>
          <div class="tech-tags">
            <span class="tag database">Laravel</span>
            <span class="tag database">MySQL</span>
            <span class="tag database">Alpine</span>
            <span class="tag database">AWS EC2</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Oct 2024</span>
          <h3>Python Flask</h3>
          <p>Web development with Python microframework</p>
          <div class="tech-tags">
            <span class="tag backend">Python</span>
            <span class="tag backend">Flask</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Sep 2024</span>
          <h3>Python Tkinter & Design Patterns</h3>
          <p>GUI development and software architecture patterns</p>
          <div class="tech-tags">
            <span class="tag backend">Python</span>
            <span class="tag backend">Design Patterns</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Jul 2024</span>
          <h3>PostgreSQL</h3>
          <p>Advanced relational database management</p>
          <div class="tech-tags">
            <span class="tag database">PostgreSQL</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Feb 2021</span>
          <h3>React.js Development</h3>
          <p>Building modern frontend applications</p>
          <div class="tech-tags">
            <span class="tag database">React</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">April 2018</span>
          <h3>Google Cloud Platform</h3>
          <p>Cloud infrastructure and services</p>
          <div class="tech-tags">
            <span class="tag devops">GCP</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Mar 2017</span>
          <h3>Laravel Framework</h3>
          <p>PHP web application framework</p>
          <div class="tech-tags">
            <span class="tag backend">Laravel</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">May 2014</span>
          <h3>CodeIgniter Framework</h3>
          <p>PHP web development framework</p>
          <div class="tech-tags">
            <span class="tag backend">CodeIgniter</span>
          </div>
        </div>

        <div class="timeline-item tech">
          <div class="timeline-dot tech"></div>
          <span class="timeline-date">Jun 2013</span>
          <h3>SEO (On-page & Off-page)</h3>
          <p>Search Engine Optimization techniques</p>
          <div class="tech-tags">
            <span class="tag backend">SEO</span>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
