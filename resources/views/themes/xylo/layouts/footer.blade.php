<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-about">
            <a href="{{ route('xylo.home') }}" class="footer-brand"><img src="{{ asset('favicon.png') }}" alt="Gia Hưng"><span><strong>Công ty Cổ phần Gia Hưng</strong><small>Giải pháp dây dẫn tin cậy cho công trình Việt</small></span></a>
            <p>Cung cấp dây đồng, cáp điện và vật tư công nghiệp với hồ sơ kỹ thuật rõ ràng, tư vấn đúng nhu cầu và giao hàng toàn quốc.</p>
            <div class="footer-cert"><span>IEC</span><span>TCVN</span><span>CO/CQ</span></div>
        </div>
        <div><h2>Khám phá</h2><ul>
            <li><a href="{{ route('xylo.home') }}">Trang chủ</a></li><li><a href="{{ route('about') }}">Giới thiệu</a></li><li><a href="{{ route('product.index') }}">Danh mục sản phẩm</a></li><li><a href="{{ route('document.index') }}">Tài liệu kỹ thuật</a></li>
        </ul></div>
        <div><h2>Hỗ trợ dự án</h2><ul>
            <li><button class="footer-link-button js-open-inquiry">Yêu cầu báo giá</button></li><li><a href="mailto:tuannm180220@gmail.com">Gửi yêu cầu qua email</a></li><li><a href="tel:0906236863">Tư vấn kỹ thuật</a></li><li><a href="{{ route('contact') }}">Thông tin liên hệ</a></li>
        </ul></div>
        <div class="footer-contact"><h2>Liên hệ</h2>
            <p><i class="fa-solid fa-location-dot"></i><span>186 Nguyễn Tuân, Thanh Xuân, Hà Nội</span></p>
            <p><i class="fa-solid fa-phone"></i><a href="tel:0906236863">0906 23 6863</a></p>
            <p><i class="fa-regular fa-envelope"></i><a href="mailto:tuannm180220@gmail.com">tuannm180220@gmail.com</a></p>
            <p><i class="fa-regular fa-clock"></i><span>Thứ 2 – Thứ 7 · 08:00 – 17:30</span></p>
        </div>
    </div>
    <div class="footer-bottom"><div class="container d-flex flex-wrap justify-content-between gap-2"><span>© {{ date('Y') }} Công ty Cổ phần Gia Hưng. Mọi quyền được bảo lưu.</span><span>MST: 0101948457</span></div></div>
</footer>
