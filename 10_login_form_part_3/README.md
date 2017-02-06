# add login authentication (part 3 of 3)

In this third and final step, we'll display login/logout links to the user depending on whether they are logged in or not, and if they are logged-in we'll also reveal the admin links in the navigation bar.

1. We need to add to our base template some conditional (IF) statements to attempt to extract the `username` from the `user` object in the session.

    First we attempt to retrieve the `user` object from the session. If it is not in the session, then Twig variable `user` will not be defined (which test for in the following step):

    ```
    {# -------- attempt to retrieve object 'user' from inside the session #}
    {% set user = app.session.get('user') %}
    ```

1. If `user` is defined, we then see if it contains an item with key `username`. If it does, we set Twig variable `username` to the retreived value - otherwise Twig variable `username` will not have been defined (we can can test for later in our template):

    ```
    {# -------- attempt to retrieve item with key 'username' from object 'user' from inside the session #}
    {% if user is defined %}
        {% if user['username'] is defined %}
            {% set username = user['username'] %}
        {% endif %}
    {% endif %}
    ```

1. Now we can have simple logic based on whether or not Twig variable `username` is set or not.

    Here we decide that if they are logged in (username is defined) then we'll display the links for routes  `/admin` and `/admin/codes`:

    ```
   <ul>
        <li>
            <a href="/">home</a>
        </li>

        <li>
            <a href="/contact">contact</a>
        </li>


        {# --------- secure links - only if logged in ----------- #}
        {% if username is defined %}
            <li>
                <hr>
                <a href="/admin">secure Admin home</a>
            </li>

            <li>
                <a href="/admin/codes">secret codes list</a>
            </li>
        {% endif %}

    ```

1. Next we decide whether to display a login link (is `username` is not defined), otherwise we display the username and display a `/logout` link:

    ```
    <!-- login / logout -->
    <section>
        {% if username is defined %}
            you are logged in as: {{ username }}
            <br>
            <a href="/logout">logout</a>
        {% else %}
            <a href="/login">login</a>
        {% endif %}
    </section>
    ```

Note, all the work is done in the Twig template, testing for the existence of variables in the session object.

Note - we could have more complex authentication by having a `role` element in object `user`, as well as the username. E.g. ROLE_USER, ROLE_ADMIN, ROLE_STUDENT etc.
