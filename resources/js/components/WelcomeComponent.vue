<template>
    <div>
        <div class="container-box">
            <div class="row card p-4">
                <div class="col-sm-12">
                    <h1>FreeAPI</h1>
                    <hr>
                    <h5>A free api for developer to build and test mobile app</h5>
                    <p>
                    <h4>List Of API EndPoint</h4>
                </div>
            </div>
        </div>
        <div class="container-box" style="margin-top: 10px;">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>POST : http://xxx/api/register</h5>
                    <code>
                        <ul>
                            <li> name : user1</li>
                            <li>email : user1@gmail.com</li>
                            <li>password : 1234</li>
                            <li>password_confirmation : 1234</li>
                        </ul>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>POST : http://xxx/api/login</h5>
                    <code>
                        login will return bearer token.Use this token for all endpoint that requires Authorization
                        <ul>
                            <li>email : user1@gmail.com</li>
                            <li>password : 1234</li>
                        </ul>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>POST : http://xxx/api/post/add_post_blog</h5>
                    <code>
                        set header Authorization with token to add post
                        <ul>
                            <li>user_id : 1</li>
                            <li>title : test</li>
                            <li>body : test body</li>
                            <li>image : happy.jpg</li>
                        </ul>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>POST : http://xxx/api/post/update_post_blog</h5>
                    <code>
                        set header Authorization with token to update post
                        <ul>
                            <li>user_id : 1</li>
                            <li>title : test</li>
                            <li>body : test body</li>
                            <li>image : happy.jpg</li>
                            <li>id : 10 // this is post id that u want to update</li>
                        </ul>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>GET : http://xxx/api/post/all_post_detail</h5>
                    <code>
                        set header Authorization with token to get post
                        <p>this will get list of all the post</p>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>DELETE : http://xxx/api/post/delete/1</h5>
                    <code>
                        set header Authorization with token to delete post
                        <p>delete post by record id</p>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>GET : http://xxx/api/user/detail/1</h5>
                    <code>
                        set header Authorization with token to get user detail
                        <p>get user detail by id</p>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>GET : http://xxx/api/user/detail/1</h5>
                    <code>
                        set header Authorization with token to update profile image
                        <p>update user profile image</p>
                        <ul>
                            <li>id: 1</li>
                            <li>profile_image: text.jpg</li>
                        </ul>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>POST : http://xxx/api/user/update/user_password</h5>
                    <code>
                        set header Authorization with token to update user password
                        <p>note: token_id is provided when login time make sure to save it for futhere use</p>
                        <ul>
                            <li>id: 1</li>
                            <li>old_password: 1234/li>
                            <li>password: 12345678</li>
                            <li>password_confirmation: 12345678</li>
                            <li>token_id:
                                07bef93865ea60183c392859d20cc119128b1857c6f162a3e980cd35a4c53a0918aa38a462d3f117
                            </li>
                        </ul>
                    </code>
                </div>
            </div>
        </div>
        <div class="container-box">
            <div class="row card p-3">
                <div class="col-sm-12">
                    <h5>POST : http://xxx/api/user/delete</h5>
                    <code>
                        set header Authorization with token to delete user
                        <ul>
                            <li>id: 1</li>
                            <li>password: 12345678</li>
                        </ul>

                    </code>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WelcomeComponent"
    }
</script>

<style scoped>

</style>
