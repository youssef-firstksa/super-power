<style>
    .reset-content {

        h2,
        h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        h3 {
            font-size: 1.25rem;
        }

        ul {
            margin-left: 2rem;
            margin-bottom: 1rem;
            list-style-type: disc;
        }

        ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
            list-style-type: decimal;
        }

        p {
            margin-bottom: 0.6rem;
            line-height: 1.5;
        }
    }
</style>

<div {{ $attributes->class(['reset-content']) }}>
    {{ $slot }}
</div>
