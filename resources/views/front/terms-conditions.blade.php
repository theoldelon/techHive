@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <h1 class="text-center mb-4">Terms and Conditions</h1>
                    <p><strong>Effective Date:</strong> November 28, 2024</p>

                    <p>Welcome to TechHive! By using this website, you agree to the following terms and conditions. If you do not agree with these terms, please do not use our site.</p>

                    <h2>1. Who Can Use TechHive</h2>
                    <p>You must be 18 years or older to use this website.</p>
                    <p>This website is intended for IT professionals, enthusiasts, and those interested in technology-related services and content. By accessing or using TechHive, you represent that you meet these eligibility requirements.</p>

                    <h2>2. Using TechHive</h2>
                    <p>You agree to use the site responsibly. This includes:</p>
                    <ul>
                        <li>Not engaging in illegal activities on the site.</li>
                        <li>Not sharing harmful, abusive, or offensive content.</li>
                        <li>Not attempting to hack, disrupt, or compromise the website or its security in any way.</li>
                    </ul>
                    <p>Failure to follow these rules may result in suspension or blocking of your access to the site.</p>

                    <h2>3. Your Account</h2>
                    <p>If you create an account on TechHive, you are responsible for maintaining the confidentiality of your account information, including your username and password. You agree to:</p>
                    <ul>
                        <li>Provide accurate and complete information when signing up.</li>
                        <li>Keep your account information up-to-date.</li>
                        <li>Notify us immediately of any unauthorized use of your account.</li>
                    </ul>

                    <h2>4. Our Content</h2>
                    <p>All content on TechHive, including articles, blog posts, graphics, logos, and other materials, are owned by us or our content partners. You may not:</p>
                    <ul>
                        <li>Copy, reproduce, or distribute any content without prior written permission.</li>
                        <li>Modify or create derivative works from our content without permission.</li>
                    </ul>
                    <p>Any unauthorized use of our content may result in legal action.</p>

                    <h2>5. Your Content</h2>
                    <p>If you share or upload content to TechHive (such as comments, reviews, articles, or multimedia), you grant us a non-exclusive, royalty-free, worldwide license to use, display, and distribute that content on our site. You are solely responsible for the content you share, and you agree not to post anything that:</p>
                    <ul>
                        <li>Is illegal, harmful, or defamatory.</li>
                        <li>Infringes on the rights of others, including intellectual property rights.</li>
                        <li>Contains viruses, malware, or other harmful code.</li>
                    </ul>

                    <h2>6. Links to Other Sites</h2>
                    <p>TechHive may contain links to third-party websites. These links are provided for your convenience, and we are not responsible for the content, actions, or privacy practices of any linked site. We encourage you to review the privacy and terms of use of any third-party website you visit.</p>

                    <h2>7. No Guarantees</h2>
                    <p>TechHive is provided "as is" without any warranties or guarantees. While we strive to provide accurate and up-to-date information, we do not guarantee the accuracy, completeness, or availability of the site or its content. We are not responsible for any errors or omissions in the content provided.</p>

                    <h2>8. Limited Liability</h2>
                    <p>We are not liable for any damages, losses, or other issues that arise from your use or inability to use the website. This includes, but is not limited to, loss of data, business interruption, or indirect damages.</p>
                    <p>Your use of the website is at your own risk. We do not accept responsibility for any direct, indirect, or consequential loss arising from your use of the website or reliance on any information provided on the site.</p>

                    <h2>9. Privacy</h2>
                    <p>We value your privacy. Please review our <a href="{{ route('privacy.policy') }}">Privacy Policy</a> to learn how we collect, use, and protect your personal information.</p>

                    <h2>10. Updates to Terms</h2>
                    <p>We may update these terms and conditions from time to time. If we make any significant changes, we will notify you via email or by posting an updated version on this page. The "Effective Date" at the top of this page will be updated to reflect the date of the most recent changes.</p>

                    <h2>11. Contact Us</h2>
                    <p>If you have any questions or concerns regarding these terms and conditions, please contact us at:</p>
                    <p><strong>Email:</strong> <a href="mailto:Techhive@gmail.com">Techhive@gmail.com</a></p>
                    <p><strong>Address:</strong> City of Naga, Cebu</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
@endsection
