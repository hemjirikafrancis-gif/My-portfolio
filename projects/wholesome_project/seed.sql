-- ============================================================
-- Wholesome Legal House – Blog Seed Data
-- Run once in phpMyAdmin or MySQL CLI:
--   USE blogs;
--   SOURCE seed.sql;
-- ============================================================

-- Make sure the table exists (safe to run even if already created)
CREATE TABLE IF NOT EXISTS `blogs` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `title`      VARCHAR(500)  NOT NULL,
  `category`   VARCHAR(100)  DEFAULT '',
  `image`      VARCHAR(300)  DEFAULT '',
  `content`    LONGTEXT      NOT NULL,
  `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `categories` (
  `id`   INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed categories
INSERT IGNORE INTO `categories` (`name`) VALUES
  ('Criminal Case'),
  ('Corporate Case'),
  ('Uncategorized');

-- Seed blog posts (skip if titles already exist)
INSERT INTO `blogs` (`title`, `category`, `image`, `content`, `created_at`)
SELECT * FROM (SELECT
  'Implications of proposed criminalization of casualization and outlawing of outsourcing and its impact on Directors/Management teams.',
  'Criminal Case',
  'Images/Blog-1.png',
  'The National Assembly of The Federal Republic of Nigeria is considering a bill for the amendment of the Labour Act. The said bill follows:

A BILL FOR AN ACT TO AMEND THE LABOUR ACT TO PROHIBIT AND CRIMINALISE CASUALIZATION OF WORKERS AFTER SIX MONTHS OF ENGAGEMENT BY EMPLOYERS IN NIGERIA, OUTSOURCING EMPLOYMENT IN CORE AREAS OF OPERATION AND FOR RELATED MATTERS

Sponsored by Hon. Tasir Olawale Raji

ENACTED by the National Assembly of the Federal Republic of Nigeria as follows:

The Labour Act (herein referred to as "The Principal Act") is hereby amended as set out hereunder.

The Principal Act is hereby amended by creating new Section 8 as follows:

S.8-(1) Every worker in Nigeria engaged or employed by and has remained in such employment for a period of not less than six months shall have his employment or engagement regularized by the Employer as a full and permanent staff of such employer with all its accompanying entitlements.

(2) Any Employer who disengages a worker after a period of six months from the date of first engagement without regularizing the worker\'s employment as in subsection 1 of this section shall at the date of disengagement pay to the worker full salary and all allowances and entitlements due to a permanent staff for six months as if the worker has been a permanent staff in the employment of the Employee for six months immediately preceding the date of disengagement provided the worker has not been found liable of any criminal act involving fraud resulting to financial loss to the company.

(3) Notwithstanding Section 23 of this Act, failure to comply with the provisions of subsections (1) and (2) above is an offence and the employer:

(a) in the case of a natural person, shall be liable on conviction to a fine not exceeding two million naira or to imprisonment for a period of two years or to both such fine and imprisonment as the Court may deem fit without prejudice to the right of the worker to his full entitlements as provided under this section.

(b) in the case of a Corporate body, shall be liable on conviction to a fine not exceeding two million naira or to imprisonment for a period of two years for each director of the Company or to both such fine and imprisonment as the Court may deem fit without prejudice to the right of the worker to his full entitlements as provided under this section.

Section 9 (1): Notwithstanding Section 25 of this Act, an employer, who has obtained the Minister\'s license, employment outsourcing by such employers within its core aims and objectives of operation is hereby prohibited. It is an offence for an employer to pay another person, whether corporate or natural person for services rendered to it by its worker.

(2) Failure to comply with the provisions of subsection (1) above, the employer shall be guilty of an offence and liable on conviction accordingly.

OPINION

What or who a casual worker is, was defined in OWENA MASS TRANSPORTATION CO. LTD v. OKONOGBO (2018) LPELR-45221(CA): "A casual worker is one who has an explicit or implicit contract of employment which is not expected to continue for more than a short period. Legally, a casual employee is seen as a worker engaged for a period of less than 6 months and who is paid at the end of each day."

Losses suffered by casual employees include abysmal low wages, absence of medical care allowances, no job security or promotion at work, no gratuity and other severance benefits, no leave or leave allowance, and jeopardized freedom of association.

The proposed amendment does not make employing casual workers a criminal offence. For an offence to be committed by an individual or body corporate employer, the employee must have been engaged for more than 6 months without having the employment regularised. Casual workers can still be engaged for periods less than 6 months.

With regards to outsourcing, this is prohibited only within areas of a company\'s core aims and objectives. The core aims and objectives are determined by examining the memorandum and articles of association as filed with the Corporate Affairs Commission.

IMPACT ON DIRECTORS AND MANAGEMENT TEAM

The proposed amendment makes the directors of the company liable on conviction to a term of imprisonment. The Directors of the company will be the persons stated in form CO7 filed with the Corporate Affairs Commission or the persons held out by the company to the general public as a Director.

SUMMARY
- It is not an offence to engage casual workers; it only becomes an offence if they are engaged for more than 6 months.
- Casual workers may be engaged for repeated cycles of less than 6 months.
- Outsourcing has not been prohibited entirely. Only outsourcing in core aims or objectives is sought to be prohibited.
- Directors and/or the company become liable for breach of terms of the Act.

As in all opinions, the above remains our viewpoint within our knowledge of the law as it stands. The proposed amendments have not been passed into law and are yet to be given judicial interpretation.

Adebisi Ilori
Wholesome Legal House',
  '2021-05-24 10:00:00'
) AS tmp
WHERE NOT EXISTS (
  SELECT 1 FROM `blogs` WHERE `title` = 'Implications of proposed criminalization of casualization and outlawing of outsourcing and its impact on Directors/Management teams.'
) LIMIT 1;

INSERT INTO `blogs` (`title`, `category`, `image`, `content`, `created_at`)
SELECT * FROM (SELECT
  'WHETHER EMPLOYMENT OF FEMALE JUNIOR STAFFS TO WORK INCLUSIVE NIGHT SHIFTS CAN BE SAID TO BE LEGAL UNDER THE LABOUR ACT',
  'Uncategorized',
  'Images/Blog-2.jpg',
  'Female employees are considered sui generis employees thereby classifying them as vulnerable due to their peculiar nature. This however is against Section 15(2) & (3), 17(3) and 42 of the 1999 Nigerian Constitution (as amended) and Protocol to the African Charter on Human and Peoples\' Right on the Right of Women in Africa, 2005, which states that females should be given equal opportunity as men in the working place. The C171 – Night Work Convention, 1990 (No. 171) provides for measures that need to be in place where there is need for night shift work, though Nigeria has not ratified same.

It is trite that Section 55(1) of the Labour Act provides that women in private or public industrial undertaking or agricultural undertaking cannot engage in manual labour overnight, exception to this are nurses and women in non-manual labour managerial positions. See Section 55(2)(1) of the Labour Act.

However, the employment of female junior staffs to work night shifts can only be allowed subject to certain conditions as stated by Section 55(5) of the Labour Act:

1. There must be a collective bargaining agreement between the company and its workers union which shall spell out the agreement to allow women work night shifts and the adequate provision and protection and other preparation in place for the women concerned.
2. The Minister of Labour and Employment may by Order exclude the applicability of Section 55(1) of the Labour Act to a company; this power is discretionary even when the requirement above is satisfied.

THE MINISTER OF LABOUR AND EMPLOYMENT MAY BY ORDER EXCLUDE THE APPLICABILITY OF SECTION 55(1)

Any company that adopts this approach is going to become one of the few companies bridging the gender gap, encouraging diversity within the industry, which is in agreement with Section 42 of the 1999 Nigerian Constitution (as amended).

However, even if a company is desirous of taking this approach, the order of the Minister of Labour and Employment is required to exempt the company from liability. The penalty of not complying with Section 55(5) of the Labour Act in breach of Section 55(1) is a fine not exceeding N100 or imprisonment for a term not exceeding one month or both.

Taking this approach could open the door to negative occurrences in the workplace, given the vulnerable nature of women. Unless strict measures are put in place, sexual harassment cases and associated vices could be witnessed. The point to bear in mind is that the Minister\'s approval being a discretionary one can be revoked upon breach of the terms and conditions set by the Minister.

WHETHER THERE ARE ANY LARGE COMPANIES ADOPTING THIS APPROACH

Instructive is the approval dated 21st January, 2019 granted by the Minister of Labour and Employment conveyed through Director of Trade Union Services and Industrial Relations of the same ministry to APM Terminals, Apapa, Lagos. The approach APM Terminals took was to file the permit application accompanied with the collective bargaining agreement which contained sufficient physical provisions and maternity policy.

THE COLLECTIVE BARGAINING AGREEMENT APPROACH

Pursuant to the Labour Act, normal working hours shall be fixed under any employment contract. Thus, working hours can be agreed on through collective bargaining within the organization or industry. The only real available option to allow women work night shift as provided under Section 55(5) of the Labour Act is through a collective bargaining agreement, which is a condition precedent for the grant of an Order by the Minister of Labour and Employment.

This approach involves a written contract between a company and the union representing the company\'s employees, covering wages, employment conditions, working hours, employee benefits, union rights and responsibilities, management rights, grievances procedures, and so on.

The agreement shall contain provisions allowing female junior staffs to work night shifts, measures in place for their transportation to work, protection against harassment and abuses, maternity policy, number of hours per shift and number of shifts per week and room for amendment.

Adebisi Ilori
Wholesome Legal House',
  '2021-05-24 11:00:00'
) AS tmp
WHERE NOT EXISTS (
  SELECT 1 FROM `blogs` WHERE `title` = 'WHETHER EMPLOYMENT OF FEMALE JUNIOR STAFFS TO WORK INCLUSIVE NIGHT SHIFTS CAN BE SAID TO BE LEGAL UNDER THE LABOUR ACT'
) LIMIT 1;

INSERT INTO `blogs` (`title`, `category`, `image`, `content`, `created_at`)
SELECT * FROM (SELECT
  'Whether an employee who is a manager but holds the title "Director" can automatically exercise all the powers of a director within the meaning of CAMA',
  'Corporate Case',
  'Images/Blog-3.png',
  'Section 269(1) of the CAMA 2020 defines a director of a company registered under the Act as: "Director of a company registered under this Act is a person duly appointed by the company to direct and manage the business of the company."

Note that the definition states that such a director must be duly appointed. The methods of appointing a person to the office of director within the meaning of the Act are laid out in Sections 272–274 as follows:

S.272: Subject to section 271 of this Act, the number of directors and the names of the first directors shall be determined in writing by the subscribers of the memorandum of association or a majority of them, or the directors may be named in the articles.

S.273(1): The members at the annual general meeting may re-elect or reject directors and appoint new ones.

S.274(1): The Board of directors may appoint new directors to fill any casual vacancy arising out of death, resignation, retirement or removal.

Due appointment is therefore made in three ways:
1. First directors: by the subscribers of the memorandum and articles of association naming them as directors.
2. By members at the annual general meeting of the company.
3. By the Board of directors to fill any casual vacancy.

Anyone who is not appointed a director in any of the ways mentioned above is not a director of the company within the meaning of the Act.

LONGE v. FBN PLC (2010) LPELR-1793(SC) confirms that the emergence of directors in a company is governed strictly by the relevant provisions of CAMA, and the combined effect of those provisions leaves no one in doubt as to the mode and manner by which an appointment of a director of a company can be made.

Consequently, a person who is not a director within the meaning of CAMA is only a director by nomenclature and not by law. The powers and rights vested in a director by law will not accrue to such an individual.

However, where third parties are concerned the case is different. If a company holds out an employee or individual as a director or puts the individual in the position of a director, the company may under certain circumstances be liable for the acts of the person so held out. There is a rebuttable presumption in favour of any person dealing with the company that all persons who are described by the company as directors, whether as executive or otherwise, are duly appointed. See S.269(2) CAMA 2020.

NWANKWO v. KAY-KAY CONSTRUCTION LTD (2014) LPELR-24336(CA) illustrates that what determines if a person is a director is not whether his or her name is listed in the particulars of directors (Form C07) in the Corporate Affairs Commission. If he occupies that position by any name called, he is a director of the company.

SUMMARY:
1. A director within the meaning of the Act must be duly appointed.
2. Without due process being followed in the appointment, the individual cannot invoke the provisions of the Act with regards to Directors.
3. A company that holds out an individual as a director may be liable to third parties for the actions of that person, whether duly appointed or not.

Adebisi Ilori
Wholesome Legal House',
  '2021-05-24 12:00:00'
) AS tmp
WHERE NOT EXISTS (
  SELECT 1 FROM `blogs` WHERE `title` = 'Whether an employee who is a manager but holds the title "Director" can automatically exercise all the powers of a director within the meaning of CAMA'
) LIMIT 1;
