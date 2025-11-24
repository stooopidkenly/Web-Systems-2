class RotatingText {
            constructor(element, options = {}) {
                this.element = element;
                this.texts = options.texts || [];
                this.rotationInterval = options.rotationInterval || 3000;
                this.currentIndex = 0;
                this.isAnimating = false;

                this.init();
            }

            createTextElement(text) {
                const container = document.createElement('span');
                container.className = 'text-rotate-container';

                const textSpan = document.createElement('span');
                textSpan.className = 'text-rotate-text';
                textSpan.textContent = text;

                container.appendChild(textSpan);
                return container;
            }

            async animateIn(container) {
                const textElement = container.querySelector('.text-rotate-text');
                textElement.classList.add('animate-in');
                await new Promise(resolve => setTimeout(resolve, 600));
            }

            async animateOut(container) {
                const textElement = container.querySelector('.text-rotate-text');
                textElement.classList.remove('animate-in');
                textElement.classList.add('animate-out');
                await new Promise(resolve => setTimeout(resolve, 400));
            }

            async showText(index) {
                if (this.isAnimating) return;
                this.isAnimating = true;

                const currentContainer = this.element.querySelector('.text-rotate-container');

                if (currentContainer) {
                    await this.animateOut(currentContainer);
                    currentContainer.remove();
                }

                this.element.innerHTML = "";

                const newContainer = this.createTextElement(this.texts[index]);
                this.element.appendChild(newContainer);
                await this.animateIn(newContainer);

                this.isAnimating = false;
            }

            next() {
                let nextIndex = this.currentIndex + 1;

                if (nextIndex >= this.texts.length) {
                    nextIndex = 0; // reset properly
                }

                this.currentIndex = nextIndex;
                this.showText(this.currentIndex);
            }

            stop() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
            }

            init() {
                this.showText(this.currentIndex);
                this.intervalId = setInterval(() => this.next(), this.rotationInterval);
            }
        }
