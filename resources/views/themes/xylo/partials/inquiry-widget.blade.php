<div class="inquiry-widget" id="inquiryWidget">
    <button class="inquiry-launcher" id="inquiryLauncher" type="button" aria-label="Chat với Gia Hưng"><i class="fa-regular fa-comments"></i><span>Chat tư vấn</span></button>
    <section class="inquiry-panel" id="inquiryPanel" aria-label="Trao đổi với Gia Hưng" hidden>
        <header><div><strong>Gia Hưng hỗ trợ</strong><small><span></span> Thường phản hồi trong giờ làm việc</small></div><button type="button" id="inquiryClose" aria-label="Đóng">×</button></header>
        <div class="inquiry-messages" id="inquiryMessages"><div class="message admin">Xin chào! Anh/chị cần tư vấn loại dây cáp hoặc báo giá cho dự án nào?</div></div>
        <form id="inquiryStartForm" class="inquiry-form">
            <input type="hidden" name="product_id" id="inquiryProductId">
            <div class="two-fields"><input name="name" required placeholder="Họ và tên *"><input name="phone" placeholder="Điện thoại"></div>
            <input name="email" type="email" placeholder="Email (nếu không có điện thoại)">
            <input name="company" placeholder="Công ty / dự án">
            <textarea name="message" required rows="3" id="inquiryInitialMessage" placeholder="Nhu cầu, quy cách, số lượng dự kiến..."></textarea>
            <button type="submit">Gửi yêu cầu <i class="fa-solid fa-arrow-right"></i></button>
        </form>
        <form id="inquiryReplyForm" class="inquiry-reply" hidden><input name="message" required placeholder="Nhập tin nhắn..."><button aria-label="Gửi"><i class="fa-solid fa-paper-plane"></i></button></form>
        <div class="inquiry-email"><a href="mailto:tuannm180220@gmail.com?subject=Yêu%20cầu%20tư%20vấn%20dây%20đồng"><i class="fa-regular fa-envelope"></i> Hoặc gửi email trực tiếp đến bộ phận bán hàng</a></div>
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const panel = document.getElementById('inquiryPanel');
    const startForm = document.getElementById('inquiryStartForm');
    const replyForm = document.getElementById('inquiryReplyForm');
    const messagesBox = document.getElementById('inquiryMessages');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    let activeThread = false;

    const openPanel = (productId = '', productName = '') => {
        panel.hidden = false;
        document.getElementById('inquiryProductId').value = productId;
        if (productName) document.getElementById('inquiryInitialMessage').value = `Tôi cần tư vấn và báo giá sản phẩm: ${productName}`;
        loadMessages();
    };
    document.getElementById('inquiryLauncher').onclick = () => panel.hidden ? openPanel() : panel.hidden = true;
    document.getElementById('inquiryClose').onclick = () => panel.hidden = true;
    document.querySelectorAll('.js-open-inquiry').forEach(button => button.addEventListener('click', () => openPanel(button.dataset.productId || '', button.dataset.productName || '')));

    const render = data => {
        if (!data.inquiry) return;
        activeThread = true;
        startForm.hidden = true;
        replyForm.hidden = data.inquiry.status === 'closed';
        messagesBox.innerHTML = data.messages.map(item => `<div class="message ${item.sender === 'admin' ? 'admin' : 'customer'}"><span>${escapeHtml(item.message)}</span><small>${item.time}</small></div>`).join('');
        messagesBox.scrollTop = messagesBox.scrollHeight;
    };
    const escapeHtml = value => { const node = document.createElement('div'); node.textContent = value; return node.innerHTML; };
    const loadMessages = () => fetch('{{ route('inquiries.messages') }}', {headers:{'Accept':'application/json'}}).then(r => r.json()).then(render).catch(() => {});
    const submit = (form, url) => fetch(url, {method:'POST', headers:{'Accept':'application/json','X-CSRF-TOKEN':csrf}, body:new FormData(form)}).then(async r => { const data = await r.json(); if (!r.ok) throw data; form.reset(); await loadMessages(); return data; });

    startForm.addEventListener('submit', event => { event.preventDefault(); submit(startForm, '{{ route('inquiries.store') }}').catch(() => alert('Vui lòng nhập họ tên và ít nhất một phương thức liên hệ.')); });
    replyForm.addEventListener('submit', event => { event.preventDefault(); submit(replyForm, '{{ route('inquiries.reply') }}'); });
    loadMessages();
    setInterval(() => { if (activeThread && !panel.hidden) loadMessages(); }, 10000);
});
</script>
