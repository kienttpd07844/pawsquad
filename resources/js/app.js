import './bootstrap';
import { TReaderDocument, renderToStaticMarkup } from '@usewaypoint/email-builder';

// Cấu hình email
const CONFIGURATION = {
  root: {
    type: 'EmailLayout',
    data: {
      backdropColor: '#F8F8F8',
      canvasColor: '#FFFFFF',
      textColor: '#242424',
      fontFamily: 'MODERN_SANS',
      childrenIds: ['block-1'],
    },
  },
  'block-1': {
    type: 'Text',
    data: {
      style: {
        fontWeight: 'normal',
        padding: {
          top: 16,
          bottom: 16,
          right: 24,
          left: 24,
        },
      },
      props: {
        text: 'Hello world', // Nội dung mặc định
      },
    },
  },
};

// Hàm render email
function renderEmail() {
  const html = renderToStaticMarkup(CONFIGURATION, { rootBlockId: 'root' });
  document.getElementById('email-preview').innerHTML = html; // Hiển thị HTML vào phần tử
}

// Hàm cập nhật nội dung email
function updateEmailContent() {
  const newText = document.getElementById('email-content').value; // Lấy nội dung từ textarea
  CONFIGURATION['block-1'].data.props.text = newText; // Cập nhật nội dung vào cấu hình
  renderEmail(); // Render lại email với nội dung mới
}

// Khởi tạo khi document sẵn sàng
document.addEventListener('DOMContentLoaded', () => {
  renderEmail(); // Hiển thị email ban đầu
  document.getElementById('update-email').addEventListener('click', updateEmailContent); // Thêm sự kiện cho nút cập nhật
});
