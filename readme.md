According to your flow I have given a particular id to all of your answers like:
1 - "Solopreneur",
2 - "Entrepreneur and/or Small Team",
3 - "Small Business Owner and/or Manager",
4 - "Freelance Service Provider",
5 - "Introduction to Outsourcing",
6 - "Done For You Outsourcing",
7 - "Integrating Outsourcing",
8 - "Understanding Freelancers",
9 - "Project Planning and Management",
10 - "Outsourcing Administrative Support",
11 - "Outsourcing Business Services",
12 - "Outsourcing Graphic Design Services",
13 - "Outsourcing IT & Networking Support",
14 - "Outsourcing Multimedia Services",
15 - "Outsourcing Sales & Marketing Services",
16 - "Outsourcing SEO & Link Building Services",
17 - "Outsourcing Software Development",
18 - "Outsourcing Website Development",
19 - "Outsourcing Writing Services"

CAUTION: Don't try to change id, on UI however you can sort the html but don't change their values.

so you can use shortcode
[recommended_text
  id="1" /*Required field*/
  description=1 /*1 or 0 if you want to show description*/
  blog=1 /*1 or 0 if you want to show blog*/
  shop=1 /*1 or 0 if you want to show shop*/
  report=1 /*1 or 0 if you want to show report*/
  title="Recommended content for Small Business Owner and/or Manager" /*Optional field*/
]
