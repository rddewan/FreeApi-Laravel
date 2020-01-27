[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
# FreeAPI - Laravel
*A free api for developer to build and test mobile app*

##### List Of API EndPoint
POST : http://xxx/api/register
```
name : user1
email : user1@gmail.com
password : 1234
password_confirmation : 1234
```


POST : http://xxx/api/login
```
//login will return bearer token.Use this token for all endpoint that requires Authorization

email : user1@gmail.com
password : 1234
```

GET : http://xxx/api/validate_token
```
//set only header 
//to check if the token is valid
Authorization : Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMWMwZTRkZjdhNWRkNmUwNDNiN2YzNjlhZWE2ZDcwZTk3YTc1ODZiMzMzZDY5MGM0MzVkNzNmNjNjZTMzYWI5YjFmMWM0ZDc5YmFmOTdmNjIiLCJpYXQiOjE1Nzg2NDY5MTEsIm5iZiI6MTU3ODY0NjkxMSwiZXhwIjoxNjEwMjY5MzExLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.etNeIq2rPZ5UM_qI-1rNF8E2V3DYCZEg_mw9wYqCUFCNnC-i5erxVyvp9SBPd9BbBSglnkl8XZHwQw3BK6f2fmtN_dKY2_EWpHunOl3b_PDeh4JwWzhH0-qqP2UClMbqQK-aWCdKf0HVqp5ZOwYIFG5cCjP2B029iDiKvI0TPt5MQZyBSkbV5DgQydu5gpx_7U5xT9cCaNFfDGzMXR7_Kqq2M7v-1kV_cX9RuHl7Q6GudnEh1ww88VdRm11LJgTtbN5yj-Df8_tpQJz4DnAz7G3P8_8oVrcjj5SiP3pXyZV7htl5Lzp_UNZIcPzYlwtBFkv3gHM_LdU0eRD3dze-uBr9J4T5xGmYwH6fAY_HSbSItla7DGJBn1e64NVR6LNbFRsj5Sv5JP2nffNW4JVcurIwiHYvVh2zMQC8wkHfeLzGyNoxcy8_vin8YnjqpH-Xy1G_hsGICwhxlby6UWmU8sv0PF6GVIwwzqZR9_LDpMT_mN3WsvIkDeGlSODKpTcBtyXLw6SNzdINGOmT0NwZenBAxqzFiKL3kQISAixB5Y0NNOdglfuxhYWKSq1GgmFFLcws-nBdktNLIAp2_OOFTO1eYrfz5SNCeuAGcwMtb60lcW8QLgma9Ae9ILFllnZeRCErk6lc8_M2yiNm3a_GGdjXy1KKLVK9TW2FAYiVVbE
```

POST : http://xxx/api/post/add_post_blog
```
//set header Authorization with token to add post
user_id : 1
title : test
body : test body
image : happy.jpg
```

POST : http://xxx/api/post/update_post_blog
```
//set header Authorization with token to update post
user_id : 1
title : test
body : test body
image : happy.jpg
id : 10 // this is post id that u want to update
```

GET : http://xxx/api/post/all_post_detail
```
//set header Authorization with token to get post
//get list of all the post
```

DELETE : http://xxx/api/post/delete/1
```
//set header Authorization with token to delete post
//delete post by record id
```

GET : http://xxx/api/user/detail/1
```
//set header Authorization with token to get user detail
//get user detail by id
```

POST : http://xxx/api/user/update/user_profile_image
```
//set header Authorization with token to update profile image
//update user profile image
id: 1
profile_image: text.jpg
```

POST : http://xxx/api/user/update/user_password
```
//set header Authorization with token to update user password
//update user password
note: token_id is provided when login time make sure to save it for futhere use

id: 1
old_password: 1234
password: 12345678
password_confirmation: 12345678
token_id: 07bef93865ea60183c392859d20cc119128b1857c6f162a3e980cd35a4c53a0918aa38a462d3f117
```

POST : http://xxx/api/user/delete
```
//set header Authorization with token to delete user
//delete user
id: 1
password: 12345678
```

<br>


[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

<h2>MIT License</h2>

Copyright (c) 2020 Richard Dewan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

