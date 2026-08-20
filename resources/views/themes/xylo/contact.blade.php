@extends('themes.xylo.layouts.master')
@section('title', 'Liên hệ | Công ty Cổ phần Gia Hưng')
@section('content')
<section class="page-hero contact-page-hero"><div class="container"><span class="eyebrow">Kết nối với Gia Hưng</span><h1>Trao đổi nhu cầu.<br>Nhận giải pháp phù hợp.</h1><p>Gửi quy cách, khối lượng hoặc bản vẽ. Chuyên viên của chúng tôi sẽ hỗ trợ trong giờ làm việc.</p></div></section>
<section class="contact-section-new"><div class="container contact-layout">
    <div class="contact-details"><span class="section-label">Thông tin liên hệ</span><h2>Công ty Cổ phần Gia Hưng</h2><p class="lead">Đối tác cung ứng dây cáp và vật tư điện cho nhà thầu, đại lý và doanh nghiệp trên toàn quốc.</p>
        <div class="contact-list"><a href="tel:0906236863"><i class="fa-solid fa-phone"></i><span><small>Hotline</small><strong>0906 23 6863</strong></span></a><a href="mailto:gicovn186@gmail.com"><i class="fa-regular fa-envelope"></i><span><small>Email bán hàng</small><strong>gicovn186@gmail.com</strong></span></a><div><i class="fa-solid fa-location-dot"></i><span><small>Văn phòng</small><strong>186 Nguyễn Tuân, Thanh Xuân, Hà Nội</strong></span></div><div><i class="fa-regular fa-clock"></i><span><small>Giờ làm việc</small><strong>Thứ 2 – Thứ 7 · 08:00 – 17:30</strong></span></div></div>
        <div class="company-meta"><span><small>Người đại diện</small>Ông Nguyễn Hữu Việt – Giám đốc</span><span><small>Mã số thuế</small>0101948457</span><span><small>Fax</small>(024) 3775 5907</span></div>
    </div>
    <div class="contact-form-card-new"><span class="section-label">Yêu cầu tư vấn</span><h2>Chúng tôi có thể giúp gì?</h2><p>Điền thông tin bên dưới. Cuộc trao đổi sẽ tiếp tục trong cửa sổ chat để bạn nhận phản hồi của quản trị viên.</p>
        <form id="contactInquiryForm"><div class="two-fields"><label>Họ và tên *<input name="name" required></label><label>Số điện thoại<input name="phone"></label></div><label>Email<input type="email" name="email"></label><label>Công ty / dự án<input name="company"></label><label>Nội dung cần tư vấn *<textarea name="message" required rows="5" placeholder="Ví dụ: Cáp CV 1x16 mm², dự kiến 2.000 m, giao tại Hà Nội..."></textarea></label><button class="btn-primary-copper" type="submit">Gửi yêu cầu <i class="fa-solid fa-arrow-right"></i></button><p class="form-result" id="contactFormResult"></p></form>
    </div>
</div></section>
<section class="map-section"><div class="container"><div class="map-copy"><span class="section-label">Văn phòng Hà Nội</span><h2>Gặp chúng tôi tại Nguyễn Tuân</h2><a target="_blank" rel="noopener" href="https://www.google.com/maps/search/?api=1&query=186+Nguyen+Tuan+Thanh+Xuan+Ha+Noi">Mở Google Maps <i class="fa-solid fa-arrow-up-right-from-square"></i></a></div><iframe title="Bản đồ Công ty Gia Hưng" loading="lazy" src="https://www.google.com/maps?q=186%20Nguyen%20Tuan%2C%20Thanh%20Xuan%2C%20Ha%20Noi&output=embed"></iframe></div></section>
@endsection
@section('js')
<script>
document.getElementById('contactInquiryForm').addEventListener('submit', async function(event) {
    event.preventDefault(); const result = document.getElementById('contactFormResult'); result.textContent = 'Đang gửi...';
    const response = await fetch('{{ route('inquiries.store') }}', {method:'POST',headers:{'Accept':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},body:new FormData(this)});
    if (response.ok) { this.reset(); result.textContent = 'Đã gửi thành công. Mở “Chat tư vấn” để xem phản hồi của Gia Hưng.'; result.className='form-result success'; }
    else { result.textContent='Vui lòng nhập họ tên, nội dung và điện thoại hoặc email.'; result.className='form-result error'; }
});
</script>
@endsection
