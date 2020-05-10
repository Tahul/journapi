@extends('layouts.app')

@section('content')
    <div class="privacy flex flex-col items-center">
        <h1 class="text-xl text-center font-bold">
            Privacy policies
        </h1>

        <div class="mt-6 box w-full">
            <div class="box-header">
                Disclaimer
            </div>

            <div class="box-inside">
                <p>
                    Last updated: May 10, 2020
                </p>

                <p class="mt-3">
                    This policy was written to the best of our ability at the current stage of product development.
                </p>

                <p class="mt-3">
                    It is subject to change at any time, and we will notify you about major changes via email.
                </p>
            </div>
        </div>

        <div class="mt-6 w-full">
            <h3>
                What this policy covers ?
            </h3>

            <p class="mt-3">
                This policy covers the data Journapi ("we") collect about you ("user"), what we do with it, why we
                collect it and how you can access it.
            </p>
        </div>

        <div class="mt-6 w-full">
            <h3>
                What this policy don't cover ?
            </h3>

            <p class="mt-3">
                We don't cover the privacy policies of the external services we use in order to offer you a great
                experience on Journapi.
            </p>

            <p class="mt-3">
                The only external service we use is <a
                    href="https://marketingplatform.google.com/about/analytics/terms/us/" target="_blank"
                >Google Analytics</a>.
            </p>
        </div>

        <div class="mt-6 w-full">
            <h3>
                What information do we collect about you?
            </h3>

            <p class="mt-3">
                We collect the informations you provide to Journapi, your name and email and bullets.
                Your password is obviously encrypted.
            </p>
        </div>

        <div class="mt-6 w-full">
            <h3>
                How do we use the data we collect about you?
            </h3>

            <p class="mt-3">
                We are only using the data in order to operate the product.
            </p>

            <p class="mt-3">
                The bullets you are writing are parsed by our server each time it is saved to parse the URLs and get
                OpenGraph data about it. This process is completely automated and we don't keep an eye on this.
            </p>
        </div>

        <div class="mt-6 w-full">
            <h3>
                Do we share your information with other organizations?
            </h3>

            <p class="mt-3">
                No. We will <b>never</b> do that.
            </p>
        </div>

        <div class="mt-6 w-full">
            <h3>
                Does your website use cookies?
            </h3>

            <p class="mt-3">
                Yes, we use cookies to store informations about the interface components and authentication so you can
                use the "Remember me" checkbox.
            </p>
        </div>

        <div class="mt-6 w-full">
            <h3>
                What happens if you end the service?
            </h3>

            <p class="mt-3">
                You will be receiving your data and the instructions to self-host the service.
            </p>

            <p class="mt-3">
                As this service is already <a href="https://github.com/Tahul/journapi" target="_blank">open source</a>,
                you can already
                do it.
            </p>
        </div>

        <div class="w-full mt-6 mb-6 flex items-center justify-between text-xs">
            <a class="block" href="{{ route('home') }}">
                Home
            </a>
            <a class="block" href="mailto:yael@ipseity.fr">
                Contact me
            </a>
        </div>
    </div>
@endsection
