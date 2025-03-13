import sys
import cv2
import pytesseract

# 명령줄 인자로 이미지 파일 경로 받기
if len(sys.argv) < 2:
    print("Usage: python main.py <image_path>")
    sys.exit(1)

image_path = sys.argv[1]

try:
    # 이미지 로드 및 OCR 실행
    image = cv2.imread(image_path)
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    thresh = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)[1]
    # OCR 적용
    custom_config = '--oem 3 --psm 6 -l ocrb'

    text = pytesseract.image_to_string(image, lang="eng", config=custom_config)
    print(text.strip())  # 결과 출력 (PHP에서 받을 값)
except Exception as e:
    print(f"Error: {str(e)}")
