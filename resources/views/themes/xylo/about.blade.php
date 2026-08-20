@extends('themes.xylo.layouts.master')

@section('title', 'Về Gia Hưng | Gần 20 năm đồng hành cùng ngành điện Việt Nam')
@section('meta_description', 'Công ty Cổ phần Gia Hưng cung ứng dây đồng, vật liệu cách điện và giải pháp kỹ thuật cho nhà thầu, đại lý và nhà máy trên toàn quốc.')

@section('content')
<section class="about-intro">
    <div class="container about-intro-grid">
        <div class="about-intro-copy">
            <span class="eyebrow">Công ty Cổ phần Gia Hưng</span>
            <h1>Uy tín được dẫn truyền qua từng công trình.</h1>
            <p>Từ năm 2006, Gia Hưng đồng hành cùng nhà thầu, đại lý và nhà máy bằng nguồn vật tư điện được chọn lọc, hồ sơ rõ ràng và tư vấn sát với nhu cầu vận hành thực tế.</p>
            <div class="about-actions">
                <a href="{{ route('product.index') }}" class="btn-primary-copper">Khám phá sản phẩm <i class="fa-solid fa-arrow-right"></i></a>
                <button type="button" class="btn-ghost js-open-inquiry">Trao đổi với chuyên viên</button>
            </div>
        </div>
        <div class="about-facts" aria-label="Những dấu mốc của Gia Hưng">
            <div><strong>2006</strong><span>Năm thành lập</span></div>
            <div><strong>18+</strong><span>Năm kinh nghiệm</span></div>
            <div><strong>63</strong><span>Tỉnh thành phục vụ</span></div>
            <div><strong>CO/CQ</strong><span>Hồ sơ minh bạch</span></div>
        </div>
    </div>
</section>

<section class="about-story">
    <div class="container about-story-grid">
        <div class="about-story-heading">
            <span class="section-label">Câu chuyện Gia Hưng</span>
            <h2>Am hiểu vật tư.<br>Thấu hiểu công trình.</h2>
        </div>
        <div class="about-story-copy">
            <p>Công ty Cổ phần Gia Hưng được thành lập ngày 17/05/2006 theo Giấy chứng nhận đăng ký kinh doanh số 0101948457.</p>
            <p>Qua gần hai thập kỷ hoạt động, chúng tôi xây dựng mạng lưới cung ứng vật tư và nguyên liệu ngành điện tại miền Bắc, đồng thời mở rộng năng lực phục vụ khách hàng trên toàn quốc.</p>
            <p>Giá trị của Gia Hưng không chỉ nằm ở sản phẩm. Đội ngũ của chúng tôi hỗ trợ lựa chọn đúng quy cách, chuẩn bị catalogue và hồ sơ kỹ thuật, phối hợp tiến độ giao hàng và theo sát nhu cầu sau bán hàng.</p>
        </div>
    </div>
</section>

<section class="about-products">
    <div class="container">
        <div class="section-head">
            <div><span class="section-label">Năng lực cung ứng</span><h2>Vật tư cho hệ thống điện bền vững</h2></div>
            <p>Danh mục được phát triển theo nhu cầu thực tế của xưởng sản xuất, nhà máy và công trình.</p>
        </div>
        <div class="about-product-grid">
            <article class="about-product-card">
                <i class="fa-solid fa-bolt"></i>
                <h3>Dây đồng & dây điện từ</h3>
                <p>Dây đồng theo cỡ AWG, dây điện từ và cuộn dây chuyên dụng cho động cơ, máy biến áp và hệ thống điện.</p>
                <ul><li>Nhiều đường kính và quy cách cuộn</li><li>Cấp chịu nhiệt từ 105°C đến 220°C</li><li>Tiêu chuẩn IEC và tiêu chuẩn tương đương</li></ul>
            </article>
            <article class="about-product-card">
                <i class="fa-solid fa-flask-vial"></i>
                <h3>Vécni tẩm cách điện</h3>
                <p>Giải pháp vécni cách điện cho động cơ và thiết bị điện, phù hợp với nhiều yêu cầu về nhiệt và môi trường.</p>
                <ul><li>Hơn 20 chủng loại chuyên dụng</li><li>Cấp nhiệt từ 130°C đến 250°C</li><li>Tư vấn lựa chọn theo ứng dụng</li></ul>
            </article>
            <article class="about-product-card">
                <i class="fa-solid fa-layer-group"></i>
                <h3>Giấy & gen cách điện</h3>
                <p>Giấy, gen, băng và vật liệu cách điện phục vụ quấn máy, bảo vệ dây dẫn và gia cường thiết bị điện.</p>
                <ul><li>Nguồn hàng đa dạng, xuất xứ rõ ràng</li><li>Gen cotton, sợi thủy tinh và vải cách điện</li><li>Cung cấp theo quy cách dự án</li></ul>
            </article>
        </div>
    </div>
</section>

<section class="about-commitment">
    <div class="container about-commitment-grid">
        <div>
            <span class="section-label">Cam kết đồng hành</span>
            <h2>Chắc chắn từ chất lượng<br>đến tiến độ.</h2>
            <div class="commitment-list">
                <article class="commitment-item"><span><i class="fa-solid fa-shield-halved"></i></span><div><h3>Chất lượng được kiểm soát</h3><p>Sản phẩm có thông tin kỹ thuật rõ ràng, được lựa chọn theo tiêu chuẩn và điều kiện sử dụng.</p></div></article>
                <article class="commitment-item"><span><i class="fa-solid fa-truck-fast"></i></span><div><h3>Giao hàng đúng cam kết</h3><p>Chủ động số lượng, quy cách và kế hoạch giao nhận theo tiến độ của từng công trình.</p></div></article>
                <article class="commitment-item"><span><i class="fa-solid fa-handshake"></i></span><div><h3>Hợp tác dài hạn</h3><p>Phản hồi minh bạch, hỗ trợ kỹ thuật thực tế và duy trì dịch vụ sau bán hàng lâu dài.</p></div></article>
            </div>
        </div>
        <aside class="about-contact-card">
            <span class="section-label light">Kết nối với chúng tôi</span>
            <h2>Bắt đầu từ nhu cầu của bạn.</h2>
            <p>Gửi quy cách, số lượng hoặc bản vẽ. Gia Hưng sẽ hỗ trợ lựa chọn và báo giá phù hợp.</p>
            <div class="about-contact-list">
                <span><i class="fa-solid fa-location-dot"></i>186 Nguyễn Tuân, Thanh Xuân, Hà Nội</span>
                <a href="tel:0906236863"><i class="fa-solid fa-phone"></i>0906 23 6863</a>
                <a href="mailto:gicovn186@gmail.com"><i class="fa-regular fa-envelope"></i>gicovn186@gmail.com</a>
            </div>
            <button type="button" class="btn-primary-copper js-open-inquiry">Chat nhận tư vấn <i class="fa-regular fa-comments"></i></button>
        </aside>
    </div>
</section>
@endsection
