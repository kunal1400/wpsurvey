This plugin is used for survey as suggested by client and also has some extended functionalities of wp-emember plugin. This plugin will generate a custom post type name email, this also generate a widget name "Email Posts".

This widget will store all visited email link in usermeta so that each user can see their visited link in sidebar. If user is not loged in then it will redirect user to Email page so please generate a page in wordpress with "email" slug.

# According to your flow I have given a particular id to all of survey answers like:
 - "Solopreneur",
 - "Entrepreneur and/or Small Team",
 - "Small Business Owner and/or Manager",
 - "Freelance Service Provider",
 - "Introduction to Outsourcing",
 - "Done For You Outsourcing",
 - "Integrating Outsourcing",
 - "Understanding Freelancers",
 - "Project Planning and Management",
 - "Outsourcing Administrative Support",
 - "Outsourcing Business Services",
 - "Outsourcing Graphic Design Services",
 - "Outsourcing IT & Networking Support",
 - "Outsourcing Multimedia Services",
 - "Outsourcing Sales & Marketing Services",
 - "Outsourcing SEO & Link Building Services",
 - "Outsourcing Software Development",
 - "Outsourcing Website Development",
 - "Outsourcing Writing Services"

# CAUTION: Don't try to change id, on UI however you can sort the html but don't change their values.

so you can use shortcode
```sh
[recommended_text
  id="1" /*Required field*/
  description=1 /*1 or 0 if you want to show description*/
  blog=1 /*1 or 0 if you want to show blog*/
  shop=1 /*1 or 0 if you want to show shop*/
  report=1 /*1 or 0 if you want to show report*/
  title="Recommended content for Small Business Owner and/or Manager" /*Optional field*/
]
```

so you can use this shortcode in any page if you want to display the widget content in page, this shortcode require the name of widget
```sh
[visited_links title='Test Posts']
```