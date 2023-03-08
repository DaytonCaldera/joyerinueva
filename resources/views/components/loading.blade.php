<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog loading-modal" role="document">
        <div class="loading_wrapper">
            <svg viewBox="0 0 100 100">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#63B3ED"/>
                        <stop offset="50%" stop-color="#00ffff"/>
                        <stop offset="100%" stop-color="#596CFF"/>
                      </linearGradient>
                </defs>
                <circle cx="50" cy="50" r="40" fill="none" stroke-width="4"
                    stroke="url(#gradient)" />
                <g transform="translate(50, 50)">
                    <rect x="-5" y="-30" width="10" height="60" rx="5" fill="#63B3ED">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 0 0"
                            to="360 0 0" dur="1s" repeatCount="indefinite" />
                    </rect>
                    <rect x="-5" y="-30" width="10" height="60" rx="5" fill="#596CFF">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 0 0"
                            to="-360 0 0" dur="1s" repeatCount="indefinite" />
                    </rect>
                </g>
            </svg>

        </div>
    </div>
</div>
