-- ============================================================
--  Borderless Analysts — Blog database
--  Import this file in phpMyAdmin (or: mysql -u root -p < database.sql)
-- ============================================================

CREATE DATABASE IF NOT EXISTS borderless_blog
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE borderless_blog;

DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  username  VARCHAR(60)  NOT NULL UNIQUE,
  password  VARCHAR(255) NOT NULL,
  full_name VARCHAR(120) NOT NULL DEFAULT 'Administrator',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categories (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE posts (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(200) NOT NULL,
  slug        VARCHAR(220) NOT NULL UNIQUE,
  category_id INT NULL,
  author      VARCHAR(120) NOT NULL DEFAULT 'Borderless Analysts Team',
  image       VARCHAR(255) NULL,
  content     LONGTEXT NOT NULL,
  featured    TINYINT(1) NOT NULL DEFAULT 0,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_post_cat FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
  FULLTEXT KEY ft_search (title, content)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin -> username: admin   password: admin123
INSERT INTO admins (username, password, full_name) VALUES
('admin', '$2y$12$nN/Y3VkKzv.Fjrlqk6Vn2eEo4Aqt11GIibbTsePMXBctogLdvny92', 'Borderless Administrator');

INSERT INTO categories (id, name) VALUES
(1, 'AI & Automation'),
(2, 'Business Analysis'),
(3, 'Data Analytics'),
(4, 'Financial Analysis'),
(5, 'Strategy'),
(6, 'Technology');

INSERT INTO posts (title, slug, category_id, author, image, content, featured) VALUES
(
 'The AI Revolution in Business: How Intelligent Automation Is Reshaping Industries',
 'ai-revolution-in-business', 1, 'Borderless Analysts Team', 'images/img-1.png',
 'Artificial intelligence is no longer a futuristic concept — it is here, and it is transforming how businesses operate, compete and grow.

At Borderless Analysts we help organisations move from AI curiosity to AI capability. The first step is never the technology; it is the process. We map how work actually flows through a business, identify the repetitive, rules-based tasks that drain analyst hours, and only then introduce automation where it produces measurable return.

Three patterns deliver the fastest value:

1. Document intelligence — invoices, contracts and reports are read, classified and summarised automatically, cutting turnaround times from days to minutes.
2. Forecasting copilots — machine learning models sit alongside finance teams, flagging anomalies in cash flow and revenue trends before they become problems.
3. Customer operations — intelligent routing and drafted responses free service teams to handle the conversations that genuinely need a human.

The organisations winning with AI are not the ones spending the most. They are the ones with clean data, clear ownership and a disciplined roadmap. Start narrow, measure honestly, and scale what works.',
 1
),
(
 'Building a Data-Driven Culture: Beyond Dashboards and Reports',
 'building-a-data-driven-culture', 3, 'Borderless Analysts Team', 'images/img-9.jpg',
 'Most organisations already have data. Very few have a data culture.

A dashboard nobody opens is not analytics — it is decoration. A genuinely data-driven organisation is one where decisions at every level are routinely defended with evidence, and where being proven wrong by the numbers is normal rather than embarrassing.

In our engagements across Africa, Europe and the Middle East, four ingredients consistently separate the leaders from the laggards:

• A single source of truth. One agreed definition of revenue, one agreed definition of an active customer. Ambiguity kills trust in reporting faster than bad data does.
• Data literacy at the middle. Executives sponsor analytics, but middle managers make or break it. Train them to read a distribution, not just a total.
• Decision rituals. Weekly reviews where a metric owner explains movement, not a slide deck that presents good news only.
• Feedback loops. Every major decision is revisited against outcomes so the organisation learns.

Technology is the easiest part of this journey. Behaviour is the work.',
 0
),
(
 'Financial Forecasting in Uncertain Times: A Practical Framework',
 'financial-forecasting-in-uncertain-times', 4, 'Borderless Analysts Team', 'images/img-12.jpeg',
 'Volatile exchange rates, shifting interest rates and unpredictable supply chains have made the traditional annual budget close to obsolete.

We advise clients to replace the single-point annual forecast with a rolling scenario model, refreshed monthly and built around three disciplined layers.

Layer one: drivers, not line items. Model the handful of variables that genuinely move your business — volume, price, FX, input cost, headcount — instead of forecasting a hundred general ledger accounts.

Layer two: scenarios with triggers. Build a base, a downside and an upside case, and attach an observable trigger to each one. When the trigger fires, the plan changes automatically instead of waiting for the next board meeting.

Layer three: cash first. Profit is an opinion, cash is a fact. Every scenario must translate into a thirteen-week cash view that treasury can act on.

Companies that adopt rolling forecasts typically cut planning cycle time by half while significantly improving accuracy. The goal is not to predict the future perfectly — it is to be ready for more than one version of it.',
 0
);
